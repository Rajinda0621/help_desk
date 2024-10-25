
{{-- 
<label class="text-white" for="dept_select">Select the department:</label>
<select name="dept_select" id="dept_select" class="rounded-md">
  <option selected desabled> Select Department </option>
  @if (isset($departments))
      @foreach ($departments as $row)
          <option value="{{ $row->id }}">{{ $row->name }}</option>
      @endforeach
  @endif
</select> --}}
<label class="text-white" for="dept_select">Select the department:</label>
<select name="dept_select" id="dept_select" class="rounded-md">
    <option value="" disabled selected>Select Department</option>
    @if (isset($departments) && count($departments) > 0)
        @foreach ($departments as $row)
            <option value="{{ $row->id }}">{{ $row->name }}</option>
        @endforeach
    @else
        <option value="" disabled>No departments available</option>
    @endif
</select>



