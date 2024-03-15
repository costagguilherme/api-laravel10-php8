<?php

namespace App\Providers;

use App\Interfaces\ICommentRepository;
use App\Interfaces\IPostRepository;
use App\Interfaces\IUserRepository;
use App\Repositories\CommentRepositoryEloquent;
use App\Repositories\PostRepositoryEloquent;
use App\Repositories\UserRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IUserRepository::class, UserRepositoryEloquent::class);
        $this->app->bind(IPostRepository::class, PostRepositoryEloquent::class);
        $this->app->bind(ICommentRepository::class, CommentRepositoryEloquent::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
