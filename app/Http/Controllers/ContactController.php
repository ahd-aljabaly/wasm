<?php

namespace App\Http\Controllers;

use App\Mail\ContactConfirmationMail;
use App\Mail\NewContactSubmission;
use App\Models\ContactSubmission;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class ContactController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'company' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'min:7', 'max:20'],
            'service' => ['required', Rule::exists('services', 'slug')],
            'message' => ['nullable', 'string', 'max:2000'],
        ], [
            'name.required' => 'الرجاء إدخال الاسم',
            'name.min' => 'الاسم قصير جداً',
            'email.required' => 'الرجاء إدخال البريد الإلكتروني',
            'email.email' => 'البريد الإلكتروني غير صحيح',
            'phone.required' => 'الرجاء إدخال رقم الهاتف',
            'service.required' => 'الرجاء اختيار الخدمة',
            'service.exists' => 'الخدمة المختارة غير صحيحة',
        ]);

        $service = Service::where('slug', $validated['service'])->first();

        $submission = ContactSubmission::create([
            'name' => $validated['name'],
            'company' => $validated['company'] ?? null,
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'service_id' => $service?->id,
            'message' => $validated['message'] ?? null,
            'status' => 'new',
            'ip_address' => $request->ip(),
            'email_sent' => false,
        ]);

        $submission->load('service');

        // إرسال إيميل إشعار للإدارة وإيميل تأكيد للعميل

        try {
            // الأولوية لإعداد notification_email من لوحة التحكم (Settings)، وإلا نرجع لقيمة .env كـ fallback احتياطي
            $adminEmail = \App\Models\Setting::get('notification_email')
                ?? config('mail.admin_address')
                ?? 'ahdkareem.j@gmail.com';

            Mail::to($adminEmail)
                ->send(new NewContactSubmission($submission));

            Mail::to($submission->email)
                ->send(new ContactConfirmationMail($submission));

            $submission->update(['email_sent' => true]);
        } catch (\Throwable $e) {
            Log::error('فشل إرسال إيميلات طلب التواصل: ' . $e->getMessage());
        }

        return response()->json([
            'success' => true,
            'message' => 'تم استلام طلبك بنجاح وسنعود إليك قريباً',
        ]);
    }
}