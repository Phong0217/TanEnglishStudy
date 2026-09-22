<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AuditLogController extends Controller
{
    public function __invoke(Request $request): Response
    {
        abort_unless($request->user()->can('audit.view'), 403);
        $query = AuditLog::latest();
        if ($action = $request->get('action')) {
            $query->where('action', $action);
        }if ($entity = $request->get('entity')) {
            $query->where('entity_type', 'like', "%{$entity}%");
        }

        return Inertia::render('Audit/Index', ['logs' => $query->paginate(20)->withQueryString(), 'filters' => $request->only('action', 'entity')]);
    }
}
