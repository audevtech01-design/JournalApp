<?php

namespace App\Http\Controllers;

use App\Models\JournalEntry;
use Illuminate\Http\Request;
use Native\Mobile\Facades\Camera;
use Native\Mobile\Facades\SecureStorage;
use Native\Mobile\Facades\PushNotifications;

class JournalController extends Controller
{
    public function index() {
	$entries = JournalEntry::orderBy('entry_date', 'desc')->get();
	return view('journal.index', compact('entries'));
   }

   public function create() {
   	return view('journal.create');
   }

   public function store(Request $request) {
	$validated = $request->validate([
	  'title' => 'required|max:255',
	  'content' => 'required',
	  'photo' => 'nullable|image',
  	]);
	
	$photoPath = null;
	if ($request->hasFile('photo')) {
	  $photoPath = $request->file('photo')->store('journal_photos');
	}

	$entry = JournalEntry::create([
	  'title' => $validated['title'],
	  'content' => $validated['content'],
	  'photo_path' => $photoPath,
	  'entry_date' => now(),
	]);

	PushNotifications::enroll('Entry saved successful');

	return redirect()->route('journal.index');
   }

   public function takePhoto() {
 	// Use NativePHP camera API
	// Camera::open()
	//   ->quality(0.8)
 	//   ->onCapture(function($photoPath) {
	//       session(['temp_photo' => $photoPath]);
	//   });

	Camera::getPhoto();

   }

   public function show(JournalEntry $entry) {
	return view('journal.show', compact('entry'));
   }

   public function destroy(JournalEntry $entry) {
	if ($entry->photo_path) {
	   SecureStorage::delete($entry->photo_path);
	}

	$entry->delete();

	PushNotifications::enroll('Entry deleted');

	return redirect()->route('journal.index');
   }

}
