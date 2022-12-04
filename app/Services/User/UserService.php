<?php

namespace App\Services\User;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserService
{
 use AuthorizesRequests;
 
    public function modalDeleteUser($model){
        $this->authorize('delete', [$model->user, 'model']);
    }
    
    

}
