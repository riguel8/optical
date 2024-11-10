<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SystemInfo;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    public function index()
    {
        $title = 'System Info';
        $systemInfo = SystemInfo::first(); 
        return view('admin.system-info', compact('systemInfo', 'title'));
    }

    public function create(Request $request)
    {
        // Create a default record if none exists
        $systemInfo = SystemInfo::create([
            'about' => 'Default about text',
            'services' => json_encode([]),
            'ophthalmologists' => json_encode([]),
        ]);

        return redirect()->route('admin.system-info.index')->with('success', 'System information created successfully!');
    }

    public function edit()
    {
        $systemInfo = SystemInfo::first();
        return view('admin.system-info', compact('systemInfo'));
    }

    public function update(Request $request, $id)
    {
        $systemInfo = SystemInfo::find($id);
    
        if (!$systemInfo) {
            return redirect()->route('admin.system-info.index')
                             ->with('error', 'System information not found.');
        }
    
        // Proceed with updating the system information
        if ($request->hasFile('carousel_images')) {
            $carouselImages = [];
            foreach ($request->file('carousel_images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('system_images', $imageName, 'public');
                $carouselImages[] = $imageName;
            }
            $systemInfo->carousel_images = $carouselImages;
        }
    
        if ($request->hasFile('about_images')) {
            $aboutImages = [];
            foreach ($request->file('about_images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('system_images', $imageName, 'public');
                $aboutImages[] = $imageName;
            }
            $systemInfo->about_images = $aboutImages;
        }

        // Handle Services and Ophthalmologists
        $systemInfo->services = json_encode($request->services);
        $systemInfo->ophthalmologists = json_encode($request->ophthalmologists);
        
        $systemInfo->save();
    
        return redirect()->route('admin.system-info.index')
                         ->with('success', 'System information updated successfully!');
    }
}
