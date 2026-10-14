<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:18px">
    <div>
        <label style="display:block;font-weight:700;margin-bottom:7px">Subject Name *</label>
        <input name="name" required maxlength="120" value="{{ old('name',$subject->name) }}" placeholder="e.g. Mathematics" style="width:100%;box-sizing:border-box;padding:12px;border:1px solid #cbd5e1;border-radius:8px">
    </div>
    <div>
        <label style="display:block;font-weight:700;margin-bottom:7px">Subject Code *</label>
        <input name="code" required maxlength="30" value="{{ old('code',$subject->code) }}" placeholder="e.g. MAT101" style="width:100%;box-sizing:border-box;padding:12px;border:1px solid #cbd5e1;border-radius:8px;text-transform:uppercase">
    </div>
</div>

<div style="margin-top:18px">
    <label style="display:block;font-weight:700;margin-bottom:7px">Description</label>
    <textarea name="description" rows="4" maxlength="2000" placeholder="Optional subject description" style="width:100%;box-sizing:border-box;padding:12px;border:1px solid #cbd5e1;border-radius:8px">{{ old('description',$subject->description) }}</textarea>
</div>

<label style="display:flex;align-items:center;gap:10px;margin-top:18px">
    <input type="checkbox" name="is_active" value="1" @checked((bool)old('is_active',$subject->exists ? $subject->is_active : true))>
    <span>Subject is active</span>
</label>

<div style="display:flex;gap:12px;flex-wrap:wrap;margin-top:24px">
    <button type="submit" style="background:#1d4ed8;color:white;border:0;padding:12px 20px;border-radius:8px;font-weight:700;cursor:pointer">Save Subject</button>
    <a href="{{ route('admin.subjects.index') }}" style="padding:12px 18px;color:#475569;text-decoration:none">Cancel</a>
</div>
