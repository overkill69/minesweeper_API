@extends('layouts.site')

@section('content')	

<div class="row">
                <div class="col-md-3">&nbsp;</div>
                <div class="col-md-6">
				
					<h2>{{ $gameP->game[0]->name }}</h2>
					<table border="1" id="container-board">
						@for( $i = 1; $i <= $gameP->game[0]->grid->height; $i++ )
							<tr>
								@for( $j = 1; $j <= $gameP->game[0]->grid->width; $j++ )
									<td align="center" width="40" height="40" class="cell">
										
										@foreach ($gameP->game[0]->grid->squares as $square)
											@if( ($square->x == (string)$i) && ($square->y == (string)$j) )
												@if($square->discover == false)
													<button class=" btn btn-secondary btn-game" id="{{$square->id}}"><i>&nbsp;</i></button>
												@else
													@if($square->content == 10)
														<button class=" btn btn-game btn-danger" id="{{$square->id}}" disable="disable"><i>&nbsp;</i></button>													
													@else
														@if($square->discover == 3)
														<button class=" btn  btn-game btn-question" id="{{$square->id}}" disable="disable"><i>&nbsp;</i></button>
														@elseif($square->discover == 2)
														<button class=" btn  btn-game btn-flag" id="{{$square->id}}" disable="disable"><i>&nbsp;</i></button>
														@else
														<button class=" btn  btn-game btn-link" id="{{$square->id}}" disable="disable"><i>&nbsp;</i></button>
														@endif
													@endif													
												@endif
											@endif
										@endforeach 
									</td>
								@endfor
							</tr>
						@endfor
					</table>

					<h4>width: {{ $gameP->game[0]->grid->width }}</h4>
					<h4>height: {{ $gameP->game[0]->grid->height }}</h4>
					<h4>bombs: {{ $gameP->game[0]->grid->bombs }}</h4>
					</div>
                <div class="col-md-3"></div>
            </div>
			<div class="dropdown-menu dropdown-menu-sm" id="context-menu">
				<a class="dropdown-item" id="flag">Flag</a>
				<a class="dropdown-item" id="question">Question</a>				
			</div>
@endsection

@section('javascripts')
<script>
$(document).ready(function(){

	var lastClick;
	
	$(".btn-secondary").on('click', function(){
		clicked = $(this);
		$.ajax({
			url: "/api/games/{{ $gameP->game[0]->id }}",
			type: 'PUT',
			data: {'sqareId': $(this).attr('id'), 'event': 'reveal', 'gameId' : '{{ $gameP->game[0]->id }}'}
		}).done(function(data){		
			console.log(data);
			$.each(data, function(gg){				
				console.log(data[gg]);
				if(data[gg].content != 10){				
					$("#"+data[gg].id).removeClass('btn-secondary').addClass('btn-link');
				}else{					
					if(clicked[0].id == data[0].id ){
						$("#"+data[gg].id).removeClass('btn-secondary').addClass('btn-danger');
						$(':button').prop('disabled', true);
						alert("GAME OVER!!!!");
						revealBombs(clicked);
						return false;
					} 										
				}
			});			
		});
	});

	function revealBombs(origin){		
		$.ajax({
			url:"/api/games/{{ $gameP->game[0]->id }}",
			type: "PUT",
			data:{'sqareId': $(origin).attr('id'),'event': "revealAllBombs" }
		})
		.done(function(data){
			$.each(data, function(gg){	
				console.log(data[gg].id);			
				$("#"+data[gg].id).removeClass('btn-secondary').addClass('btn-danger');				
			});			
		});
	}

	$('.btn-secondary').on('contextmenu', function(e) {
		var top = e.pageY - 10;
		var left = e.pageX - 90;
		var clicked = $(this).attr('id');
		//console.log(clicked);
		lastClick = clicked;
		$("#context-menu").css({
			display: "block",
			top: top,
			left: left
		}).addClass("show");
			return false; //blocks default Webbrowser right click menu
		}).on("click", function(clicked) {			
			$("#context-menu").removeClass("show").hide();
	});

	$("#context-menu a").on("click", function() {
		updateStatus($(this).attr('id'), lastClick)
		$(this).parent().removeClass("show").hide();
	});

	function updateStatus(status, SqtId){
		$.ajax({
			url:"/api/games/{{ $gameP->game[0]->id }}",
			type: "PUT",
			data:{'event': "updateStatus", 'status': status ,'sqareId': SqtId }
		})
		.done(function(data){					
			$.each(data, function(gg){	
				if(data.discover === 2){
					$("#"+data.id).removeClass('btn-secondary').addClass('btn-flag');				
				}if(data.discover === 3){				
					$("#"+data.id).removeClass('btn-secondary').addClass('btn-question');				
				}
			});			
		});
	}

	
	function doAjax() {
		$.ajax({
				url:"/api/games/{{ $gameP->game[0]->id }}",
				type: "PUT",
				data:{'event': "updateStatus", 'status': status ,'sqareId': SqtId },
				dataType: 'json',
				success: function (data) {
					if(data == 1){
						$
					}
				}
				
		});
	}
});
</script>

@endsection

