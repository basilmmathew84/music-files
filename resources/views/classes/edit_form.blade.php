

@if (auth()->user()->roles[0]->id != 3)
	
<div class="form-group">
    <label for="name" class="col-md-2 control-label">{{ trans('classes.tutor') }}<sup style="color:red">*</sup></label>
	<div class="col-md-10">
        <select name="tutor_user_id" id="tutor_id" onchange="getStudents()" class="form-control" disabled>
			
			@foreach ($tutors as $l => $tutor)
				<option value="{{$l}}" @if($classes->tutor_user_id ==$l) selected @endif>{{$tutor}}</option>
			@endforeach
        </select>
		<input type="hidden" name="tutor_user_id" value="{{$classes->tutor_user_id}}">
	</div>
</div>
	
@endif

<div class="form-group">
    <label for="name" class="col-md-2 control-label">{{ trans('classes.student') }}<sup style="color:red">*</sup></label>
	<div class="col-md-10">
        <select name="student_user_id" id="student_user_id" class="form-control" disabled>
			
				
				@foreach ($students as $k => $student)
				<option value="{{$k}}" @if($classes->student_user_id ==$k) selected @endif>{{$student}}</option>
			@endforeach
			
        </select>
		<input type="hidden" name="student_user_id" value="{{$classes->student_user_id}}">
	</div>
</div>



<div class="form-group {{ $errors->has('dob') ? 'has-error' : '' }}">
    <label for="dob" class="col-md-2 control-label">{{ trans('classes.date') }}<sup style="color:red">*</sup></label>
    <div class="col-md-10">
        <input class="form-control datepicker" name="date" type="text" id="dob"
            value="{{ old('dob', optional($classes)->date) }}" minlength="1" maxlength="255" required="true"
            placeholder="{{ trans('classes.date__placeholder') }}" readonly>
        {!! $errors->first('dob', '<p class="text-danger">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('dob') ? 'has-error' : '' }}">
    <label for="dob" class="col-md-2 control-label">{{ trans('classes.summary') }}<sup style="color:red">*</sup></label>
    <div class="col-md-10">
        <textarea class="form-control text-editor" name="summary" id="summary">{{ old('summary', optional($classes)->summary) }}</textarea> 
		{!! $errors->first('dob', '<p class="text-danger">:message</p>') !!}
    </div>
</div>

<br></br><input type="file" name="attachment[]" multiple><br></br>

<h3>{{ trans('classes.files') }}</h3>
                    @foreach ($files as $file)
                            <a target="_blank" href="{{asset('uploads/files_'.$classes->id.'/'.$file)}}">{{ $file }}</a>
							<a href="#" style="float:right;margin-right:20%" onclick="return deleteImage('<?php echo 'uploads/files_'.$classes->id.'/'.$file; ?>')"><i class="fas fa-trash-alt"></i> </a>
							</br>
                        @endforeach

<br></br>

<script>
function deleteImage(file)
{
    var r = confirm("Are you sure you want to delete this File?")
    if(r == true)
    {
		alert(file);
        $.ajax({
          url: "{{ route('tutor.classes.remove_file') }}",
          data: {'file' : file },
          success: function (response) {
             location.reload(); 
          },
          error: function () {
             alert('Error.please try again');
          }
        });
    }
}
</script>













