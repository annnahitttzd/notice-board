<?php
namespace App\Http\Controllers;
use App\Jobs\SendStoryApprovalEmail;
use Illuminate\Http\Request;
use App\Models\Story;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use function Laravel\Prompts\error;

class StoryController extends Controller
{
    public function create()
    {
        return view('story');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
        ]);
        if ($validatedData) {
            $uuid = Str::uuid()->toString();
            $token = str_replace('-', '', $uuid);
            $data = [
                'title' =>$validatedData['title'],
                'description' => $validatedData['description'],
                'approve_token' => $token,
            ];
        }
        $story = Story::create($data);
        SendStoryApprovalEmail::dispatch($story)->onQueue('emails');
        return redirect('/admin/add-story')->with('success', 'Story added successfully!');
    }

    public function approveStory(Request $request )//, $approve_token)
     {
        $story = Story::where('approve_token', $request->approve_token)->firstOrFail();
        $story->update(['approved' => 1]);
        return view('approved') ;
    }
    public function showApprovedStories()
    {
        $approvedStories = Story::where('approved', true)->get();
       if (request()->wantsJson()) {
            return response()->json($approvedStories);
        }
        return view('approved-stories', ['approvedStories' => $approvedStories]);

//        return view('approved-stories', compact('approvedStories'));


    }
    public function storyDelete($id)
    {
        $story = Story::find($id);
        $story->delete();
        return redirect()->back()->with('success', 'Story deleted successfully!');
    }


}
