<?php
namespace App\Http\Controllers;
use App\Jobs\SendStoryApprovalEmail;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\Story;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use function Laravel\Prompts\error;
use App\Events\StoryApproved;
class StoryController extends Controller
{
    public function create(Request $request)
    {
        $adminEmail = $request->get('adminEmail' );
        return view('story', compact('adminEmail'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:3000',
        ]);
        if ($validatedData) {
            $uuid = Str::uuid()->toString();
            $token = str_replace('-', '', $uuid);
            $data = [
                'title' =>$validatedData['title'],
                'description' => $validatedData['description'],
                'approve_token' => $token,
                'creator_id'  => Auth::guard('admin')->user()->id,
            ];
        }
        $story = Story::create($data);
        SendStoryApprovalEmail::dispatch($story)->onQueue('emails');

        return redirect('/admin/add-story')->with('success', 'Story added successfully!');
    }
    public function approveStory(Request $request)
     {
        $story = Story::where('approve_token', $request->approve_token)->firstOrFail();
         if ($story->approved) {
             return redirect()->route('approved.stories')->with('message', 'This story is already approved.');
         }
        $story->update(['approved' => 1]);
        broadcast(new StoryApproved($story));
        Auth::guard('admin')->login(Admin::find($story->creator_id));

         return redirect()->route('approved.stories');
    }
    public function showApprovedStories()
    {
        $adminId = Auth::guard('admin')->user()->id;
        $approvedStories = Story::where('approved', true)
            ->where('creator_id', $adminId)
            ->get();
       if (request()->wantsJson()) {
            return response()->json($approvedStories);
        }

        return view('approved-stories', ['approvedStories' => $approvedStories]);
    }
    public function storyDelete($id)
    {
        $story = Story::find($id);
        $story->delete();
        return redirect()->back()->with('success', 'Story deleted successfully!');
    }


}
