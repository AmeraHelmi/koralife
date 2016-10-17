<div class="actions" >
	<button type="button" class="edit Btn btn btn-default btn-xs" data-id="{{$id}}"> تعديل <i class="fa fa-pencil"></i></button>
	<form action="{{ url( strtolower($controller), $id) }}" class="deleteForm" method="POST" style="display: inline;">
		<input type="hidden" name="_method" value="DELETE">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button>
	</form>
	@if($publish == 'YES')
  <button type="button" class="btn btn-danger btn-xs nopublish" value="{{$id}}"  data-id="{{$id}}">الغاء الخبر</button>
  @else
	<button type="button" class="btn btn-primary btn-xs publish" value="{{$id}}" data-id="{{$id}}" >نشـــــــر</button>
  @endif
</div>
