<div class="row g-3">
    <div class="col-md-6">
        <label for="student_id" class="form-label">Student *</label>
        <select name="student_id" id="student_id" class="form-select" required>
            <option value="">Select student</option>
            @foreach($students as $student)
                <option value="{{ $student->id }}"
                    @selected((string) old('student_id', $result->student_id ?? '') === (string) $student->id)>
                    {{ $student->student_number }} — {{ $student->first_name }}
                    {{ $student->last_name }} ({{ $student->class_name }})
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label for="subject_id" class="form-label">Subject *</label>
        <select name="subject_id" id="subject_id" class="form-select" required>
            <option value="">Select subject</option>
            @foreach($subjects as $subject)
                <option value="{{ $subject->id }}"
                    @selected((string) old('subject_id', $result->subject_id ?? '') === (string) $subject->id)>
                    {{ $subject->name }} ({{ $subject->code }})
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label for="academic_session" class="form-label">Academic Session *</label>
        <input type="text" name="academic_session" id="academic_session"
               class="form-control" placeholder="2026/2027"
               value="{{ old('academic_session', $result->academic_session ?? '2026/2027') }}"
               maxlength="20" required>
    </div>

    <div class="col-md-6">
        <label for="term" class="form-label">Term *</label>
        <select name="term" id="term" class="form-select" required>
            @foreach($terms as $term)
                <option value="{{ $term }}"
                    @selected(old('term', $result->term ?? 'First Term') === $term)>
                    {{ $term }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label for="ca_score" class="form-label">Continuous Assessment (out of 40) *</label>
        <input type="number" name="ca_score" id="ca_score" class="form-control"
               min="0" max="40" step="0.01"
               value="{{ old('ca_score', $result->ca_score ?? '') }}" required>
    </div>

    <div class="col-md-6">
        <label for="exam_score" class="form-label">Examination (out of 60) *</label>
        <input type="number" name="exam_score" id="exam_score" class="form-control"
               min="0" max="60" step="0.01"
               value="{{ old('exam_score', $result->exam_score ?? '') }}" required>
    </div>

    <div class="col-12">
        <label for="teacher_comment" class="form-label">Teacher's Comment (optional)</label>
        <textarea name="teacher_comment" id="teacher_comment" class="form-control"
                  rows="3" maxlength="2000">{{ old('teacher_comment', $result->teacher_comment ?? '') }}</textarea>
    </div>

    <div class="col-12">
        <div class="alert alert-info mb-0">
            <strong>Scoring:</strong> CA (maximum 40) + examination (maximum 60) = total out of 100.
            The system calculates the grade automatically.
        </div>
    </div>
</div>
