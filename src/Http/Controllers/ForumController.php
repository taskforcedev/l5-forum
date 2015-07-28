<?php namespace Taskforcedev\LaravelForum\Http\Controllers;

use Taskforcedev\LaravelForum\Forum;

/**
 * Class ForumController
 * @package Taskforcedev\LaravelForum\Http\Controllers
 */
class ForumController extends BaseController
{
    public function index()
    {
        $data = $this->buildData();
        return view('laravel-forum::forum.index', $data);
    }

    public function view($id)
    {
        $forum = $this->validateForumId($id);

        if ($forum === false) {
            return view('404');
        }

        $data = $this->buildData();
        $data['forum'] = $forum;

        return view('laravel-forum::forum.forum', $data);
    }

    public function createPost($forum_id)
    {
        $forum = $this->validateForumId($forum_id);

        if ($forum === false) {
            return view('404');
        }

        $data = $this->buildData();
        $data['forum'] = $forum;

        return view('forum/createPost', $data);
    }

    /**
     * Validates if the forum exists, if so returns it.
     *
     * @param integer $id
     *
     * @return mixed
     */
    private function validateForumId($id)
    {
        try {
            $forum = Forum::where('id', $id)->firstOrFail();
            return $forum;
        } catch (\Exception $e) {
            return false;
        }
    }
}
