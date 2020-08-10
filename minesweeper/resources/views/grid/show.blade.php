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
									<td align="center" width="50" height="50">
										
										@foreach ($grid->squares as $square)
											@if( ($square->x == (string)$i) && ($square->y == (string)$j) )
												@if($square->discover == false)
													<button class=" btn btn-secondary" id="{{$square->id}}"><i>&nbsp;</i></button>
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
		clicked = $(this);
		$.post("/games/{{ $gameP->id }}/events",{'sqareId': $(this).attr("id"), 'event': "reveal" })
		.done(function(data){		
			$.each(data, function(gg){				
				if(data[gg].content != 10){				
					$("#"+data[gg].id).removeClass('btn-secondary').addClass('btn-success');
				}else{					
					if(clicked[0].id == data[0].id ){
						$("#"+data[gg].id).removeClass('btn-secondary').addClass('btn-danger');
						$(':button').prop('disabled', true);
						alert("GAME OVER!!!!");
						revealBombs();
						return false;
					} 										
				}
			});			
		});
	});

	function revealBombs(){
		$.post("/games/{{ $gameP->id }}/events",{'event': "revealAllBombs" })
		.done(function(data){					
			$.each(data, function(gg){	
				//console.log(data[gg].id);			
				$("#"+data[gg].id).removeClass('btn-secondary').addClass('btn-danger');				
			});			
		});
	}

});
</script>

@endsection

