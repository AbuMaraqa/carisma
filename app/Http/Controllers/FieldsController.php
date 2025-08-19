<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Field;
use App\Models\User;
use App\Models\UserGroups;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class FieldsController extends Controller
{
    public function store(Request $request, Event $event)
    {
        // بما أن مفتاحك الأساسي eid:
        // تأكد أن Model Event مضبوط: protected $primaryKey='eid';
        $data = $request->validate([
            'name' => ['required', 'alpha_dash', Rule::unique('event_fields', 'name')->where('event_id', $event->eid)],
            'label' => ['required', 'string', 'max:255'],
            'type' => ['required', Rule::in(['text', 'textarea', 'email', 'number', 'date', 'select', 'checkbox', 'file'])],
            'is_required' => ['nullable', 'boolean'],
            'order' => ['nullable', 'integer'],
            'options' => ['array'],
            'options.placeholder' => ['nullable', 'string'],
            'options.min' => ['nullable', 'numeric'],
            'options.max' => ['nullable', 'numeric'],
            'options.choices' => ['array'],
            'options.choices.*' => ['nullable', 'string'],
        ]);

        $data['event_id'] = $event->eid;
        $data['is_required'] = (bool)($data['is_required'] ?? false);

        Field::create($data);

        return back()->with('success', 'تمت إضافة الحقل بنجاح.');
    }

    public function destroy(Field $field)
    {
        $field->delete();
        return back()->with('success', 'تم حذف الحقل.');
    }

    public function sort(Request $request, Event $event)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|integer|exists:event_fields,id',
            'items.*.order' => 'required|integer',
        ]);

        foreach ($request->items as $item) {
            Field::where('id', $item['id'])
                ->where('event_id', $event->eid)
                ->update(['order' => $item['order']]);
        }
        return response()->json(['ok' => true]);
    }
}
