<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;
use App\User;
use App\Models\Document;
use ImageUpload;

class Documents extends Controller
{
    public function index() 
    {
        $icons = [
            'pdf' => 'pdf',
            'doc' => 'word',
            'docx' => 'word',
            'xls' => 'excel',
            'xlsx' => 'excel',
            'ppt' => 'powerpoint',
            'pptx' => 'powerpoint',
            'txt' => 'text',
            'png' => 'image',
            'jpg' => 'image',
            'jpeg' => 'image',
        ];

        $documents = Document::where('user_id', auth()->user()->id)->get();
        return view('vendor.documents.index', ['documents' => $documents, 'icons' => $icons]);
    }

    public function upload(Request $request)
    {

            $dates = [];
            $files = [];

            if ($request->file('notary_license')) $files[] = $request->file('notary_license'); else $files[] = '';
            if ($request->file('e_and_o')) $files[] = $request->file('e_and_o'); else $files[] = '';
            if ($request->file('background_check')) $files[] = $request->file('background_check'); else $files[] = '';
            if ($request->file('nna_certification')) $files[] = $request->file('nna_certification'); else $files[] = '';
            if ($request->file('state_title_license')) $files[] = $request->file('state_title_license'); else $files[] = '';

            if ($request->input('notary_license_date')) $dates[] = $request->input('notary_license_date'); else $dates[] = '';
            if ($request->input('e_and_o_date')) $dates[] = $request->input('e_and_o_date'); else $dates[] = '';
            if ($request->input('background_check_date')) $dates[] = $request->input('background_check_date'); else $dates[] = '';
            if ($request->input('nna_certification_date')) $dates[] = $request->input('nna_certification_date'); else $dates[] = '';
            if ($request->input('state_title_license_date')) $dates[] = $request->input('state_title_license_date'); else $dates[] = '';

            $document_name = array(
                auth()->user()->id.'-NOTARY_LICENSE',
                auth()->user()->id.'-E_AND_O',
                auth()->user()->id.'-BACKGROUND_CHECK',
                auth()->user()->id.'-NNA_CERTIFICATION',
                auth()->user()->id.'-STATE_TITLE_LICENSE',
                auth()->user()->id.'-OTHER_DOCUMENT'
            );

            for($counter=0; $counter<5; ) {
                if(!empty($files[$counter])){
                    $fileExt = $files[$counter]->getClientOriginalExtension();
                    $date = $dates[$counter];
                    $files[$counter]->move(
                        base_path().'/public/images/', $document_name[$counter].'.'.$fileExt
                    );
                    Document::updateOrCreate(
                    [   'user_id'   => Auth::user()->id,
                        'document' => $document_name[$counter].'.'.$fileExt
                    ],
                    [
                        'document' => $document_name[$counter].'.'.$fileExt,
                        'date_exp' => \Carbon\Carbon::parse($date),
                        'user_id' => $request->user_id
                    ]);
                }
                $counter++;
            }

            foreach ($request->file('other_document') as $key => $file) {
                if(!empty($file)){
                    try {
                        $otherDocumentName = $file->getClientOriginalName();
                        // $file->store('users/' . $this->user->id . '/messages');
                        $file->move(
                        base_path().'/public/images/', $document_name[$key].$otherDocumentName);
                        Document::create([
                            'document' => $document_name[5].$otherDocumentName,
                            'user_id' => $request->user_id
                        ]);
                    } catch (Throwable $e) {
                        report($e);
                        return false;
                    }
                }
            }
            
            $output = array(
                'success' => 'Document uploaded successfully'
            );

           return response()->json($output);
    }
}
