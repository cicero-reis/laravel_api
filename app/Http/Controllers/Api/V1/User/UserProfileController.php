<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Core\User\UseCases\Interfaces\UserProfileUserCaseInterface as InterfacesUserProfileUserCaseInterface;
use App\Http\Controllers\Controller;
use App\Infrastructure\AWS\S3\S3Service;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    private $s3Service;

    private $userProfileUserCase;

    public function __construct(S3Service $s3Service, InterfacesUserProfileUserCaseInterface $userProfileUserCase)
    {
        $this->s3Service = $s3Service;
        $this->userProfileUserCase = $userProfileUserCase;
    }

    public function upload(Request $request, $id): JsonResponse
    {
        $request->validate([
            'image' => 'required|image|max:5120',
        ]);

        $user = User::findOrFail($id);
        $file = $request->file('image');
        $path = 'uploads/users/'.$user->id.'/'.uniqid().'.'.$file->getClientOriginalExtension();
        $this->s3Service->upload($path, file_get_contents($file));
        $resource = $path;

        // Atualiza o caminho da imagem de perfil usando o caso de uso
        $this->userProfileUserCase->execute($user->id, $resource);

        return response()->json(['resource', $resource], 201);
    }
}
