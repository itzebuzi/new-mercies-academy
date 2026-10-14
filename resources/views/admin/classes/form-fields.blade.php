<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:18px">
    <div>
        <label style="display:block;font-weight:700;margin-bottom:7px">Class Name *</label>
        <input name="name" required maxlength="100" value="{{ old('name',$schoolClass->name) }}" placeholder="e.g. Primary 1" style="width:100%;box-sizing:border-box;padding:12px;border:1px solid #cbd5e1;border-radius:8px">
    </div>
    <div>
        <label style="display:block;font-weight:700;margin-bottom:7px">Education Level *</label>
        <select name="level" required style="width:100%;padding:12px;border:1px solid #cbd5e1;border-radius:8px">
            <option value="primary" @selected(old('level',$schoolClass->level ?: 'primary')==='primary')>Primary</option>
            <option value="junior_secondary" @selected(old('level',$schoolClass->level)==='junior_secondary')>Junior Secondary</option>
            <option value="senior_secondary" @selected(old('level',$schoolClass->level)==='senior_secondary')>Senior Secondary</option>
        </select>
    </div>
    <div>
        <label style="display:block;font-weight:700;margin-bottom:7px">Section</label>
        <input name="section" maxlength="30" value="{{ old('section',$schoolClass->section) }}" placeholder="e.g. A (optional)" style="width:100%;box-sizing:border-box;padding:12px;border:1px solid #cbd5e1;border-radius:8px">
    </div>
    <div>
        <label style="display:block;font-weight:700;margin-bottom:7px">Student Capacity *</label>
        <input type="number" name="capacity" min="1" max="500" required value="{{ old('capacity',$schoolClass->capacity ?: 40) }}" style="width:100%;box-sizing:border-box;padding:12px;border:1px solid #cbd5e1;border-radius:8px">
    </div>
</div>

<div style="margin-top:18px">
    <label style="display:block;font-weight:700;margin-bottom:7px">Description</label>
    <textarea name="description" rows="4" maxlength="2000" placeholder="Optional class information" style="width:100%;box-sizing:border-box;padding:12px;border:1px solid #cbd5e1;border-radius:8px">{{ old('description',$schoolClass->description) }}</textarea>
</div>

<label style="display:flex;align-items:center;gap:10px;margin-top:18px">
    <input type="checkbox" name="is_active" value="1" @checked((bool)old('is_active',$schoolClass->exists ? $schoolClass->is_active : true))>
    <span>Class is active</span>
</label>

<div style="display:flex;gap:12px;flex-wrap:wrap;margin-top:24px">
    <button type="submit" style="background:#1d4ed8;color:white;border:0;padding:12px 20px;border-radius:8px;font-weight:700;cursor:pointer">Save Class</button>
    <a href="{{ route('admin.classes.index') }}" style="padding:12px 18px;color:#475569;text-decoration:none">Cancel</a>
</div>
