@extends('layouts.site')

@section('content')	

<div class="row">
                <div class="col-md-3">&nbsp;</div>
                <div class="col-md-6">
					<h2>{{ $gameP->name }}</h2>
					<table>
						@for( $i = 1; $i <= $grid->height; $i++ )
							<tr>
								@for( $j = 1; $j <= $grid->width; $j++ )
									<td align="center" width="25" height="25">
										
										@foreach ($grid->squares as $square)
											@if( ($square->x == (string)$i) && ($square->y == (string)$j) )
												@if($square->discover == false)
													<button class=" btn btn-secondary" id="{{$square->id}}"><i>{{$square->id}} !! x={{$square->x }} || {{$square->y}}</i></button>
												@else
													{{ $square->content != '0' ? $square->content : '' }}
												@endif
											@endif
										@endforeach 
									</td>
								@endfor
							</tr>
						@endfor
					</table>

					<h4>width: {{ $grid->width }}</h4>
					<h4>height: {{ $grid->height }}</h4>
					<h4>bombs: {{ $grid->bombs }}</h4>
					</div>
                <div class="col-md-3"></div>
            </div>

@endsection

@section('javascripts')
<script>
$(document).ready(function(){

	$(".btn-secondary").on('click', function(){
		//alert($(this).attr("id"));
		clicked = $(this);
		$.post("/games/{{ $gameP->id }}/events",{'sqareId': $(this).attr("id"), 'event': "reveal" })
		.done(function(data){
			//alert(data);
			$.each(data, function(gg){
				//alert(data[gg].id);
				if(data[gg].id != undefined){				
					$("#"+data[gg].id).removeClass('btn-secondary').addClass('btn-success');
				}
			});			
		});
	})

});
</script>

@endsection

