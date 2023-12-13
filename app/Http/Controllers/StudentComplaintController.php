<?php

namespace App\Http\Controllers;

use App\Mail\AdminReceivedMail;
use App\Mail\ComplaintSubmittedMail;
use App\Models\Attachments;
use App\Models\Category;
use App\Models\StudentCompl;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class StudentComplaintController extends Controller
{
    public function AllComplaints()
    {
        $my_complaints = StudentCompl::latest()->get()->where('user_id', Auth::user()->id);
        $category = Category::get();

        return view('student.all_complaints', compact('my_complaints', 'category'));
    }

    public function ShowAddComplaintPage()
    {
        $category = Category::get();
        return view('student.add_complaint', compact('category'));
    }

    public function storeComplaint(Request $request)
    {
        // validate request data
        $validated = $request->validate([
            'description' => 'required|max:255',
            'date_of_occurence' => 'required|date',
            'category_id' => 'required',
            // 'attachments.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // new complaint
        $complaint = StudentCompl::create([
            'user_id' => Auth::user()->id,
            'description' => $request->description,
            'date_of_occurence' => $request->date_of_occurence,
            'category_id' => $request->category_id,
            'created_at' => now(),
        ]);

        $compl = new StudentCompl;


        foreach ($request->file('attachments') as $imagefile) {
            $image = new Attachments();
            $path = $imagefile->store('/images/resource', ['disk' =>   'my_files']);
            $image->url = $path;
            $image->complaint_id = $complaint->id;
            $image->save();
        }

        // dd($complaint, $image);

        // data for email
        $data = [
            'name' => Auth::user()->name,
            'description' => $request->description,
            'date_of_occurence' => $request->date_of_occurence,
            'category_id' => $request->category_id,
            // 'attachments' => $images, // if you want to attach image details to the email
        ];

        // confirmation email to admin
        Mail::to('admin@gmail.com')->send(new AdminReceivedMail($data));

        // confirmation email to user
        Mail::to(Auth::user()->email)->send(new ComplaintSubmittedMail($data));

        // Redirect to the desired route
        return back()
            ->with('success', 'You have successfully upload image.');
        // ->with('images', $images);
    }

    public function UpdateComplaint(Request $request, $id)
    {

        $complaint = StudentCompl::findOrFail($id);

        $test = $complaint->update([
            'description' => $request->description,
            'category_id' => $request->category_id,
        ]);

        // dd($test);

        return redirect()->route('show.all.complaints');
    }

    public function DeleteComplaint($id)
    {
        $complaint = StudentCompl::findOrFail($id);

        if ($complaint->user_id == Auth::user()->id) {
            $complaint->delete();
            return Redirect::back()->with('success', 'Complaint deleted successfully.');
        } else {
            return Redirect::back()->with('error', 'You are not authorized to delete this complaint.');
        }
    }

    public function openTickets()
    {
        $openTickets = StudentCompl::getOpenTickets();

        return view('student.open_tickets', compact('open_tickets'));
    }
}
