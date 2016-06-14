@extends('layouts.adminMaster')

@section('style')
	{!! Html::style( 'css/custom.css' ) !!}
	{!! Html::style( 'css/referral-tree.css' ) !!}
	{!! Html::style( '//fonts.googleapis.com/css?family=Raleway') !!}

	<style type="text/css">
		
	</style>
	
	
@endsection

@section('page-heading')
	{{-- @include('partials.top-heading') --}}
@endsection

@section('body-content')
	@include('depoMsg')

		<div class="row">
			<div class="col-md-4 col-sm-4 col-md-offset-4 col-sm-offset-4">
				
					<div class="form-group">
						<input type="text" name="search" id="search" class="form-control" placeholder="Search user"> 
						<span class="pull-right sicon"><i class="fa fa-search"></i> </span>
					</div>
				
			</div>
			<div class="col-md-4 col-sm-4 col-md-offset-4 col-sm-offset-4">
				<div class="result" id="result">
					
				</div>
			</div>

		</div>
		<div class="row">
			<div class="retree">
				<div class="col-md-1 hide">
					<ul>
						<li><div class="activated"></div> Activated</li>
						<li><div class="registerd"></div> Registerd</li>
						<li><div class="blank"></div> Blank</li>
					</ul>
				</div>
				<div class="col-md-11">


						<div class="referral-tree">


						
						{{-- @foreach ( $tree as $trees) --}}

							@if($topUserInfo['status'] === 1)
								<div class="circle-wrapper">
									<a href=" {{ $topUserInfo['/username'] }} ">
										<div class="top-user activated">
											<p class="tree-text"> {{ $topUserInfo['username'] }} </p>
										</div>
									</a>
										@include('accounts.referralTables.topUserTable')
								</div>

							@else
								<div class="circle-wrapper">
									<a href=" {{ $topUserInfo['/username'] }} ">
										<div class="top-user registerd">
											<p class="tree-text"> {{ $topUserInfo['username'] }} </p>
										</div>
									</a>
										@include('accounts.referralTables.topUserTable')
								</div>
							@endif

							
							
							<div class="first-verticle-line"></div>
							
							<div class="first-horizontal-line"></div>
							


							@if( $child1 === null)

								<div class="child-left-1 blank">
									<p class="tree-text">{{ 'Blank' }}</p>
								</div>
							
							@elseif ($child1['status'] === 1 )

								<div class="circle-wrapper1">
									<a href="{{ URL::to('referralTree/'. $child1[ 'username' ])}}">
									<div class="child-left-1 activated">
										 <p class="tree-text">{{ $child1['username'] }}</p> 
									</div>
									</a>
									@include('accounts.referralTables.childOne')
								</div>


							@else

								<div class="circle-wrapper1">
									<a href="{{ URL::to('referralTree/'. $child1[ 'username' ])}}">
									<div class="child-left-1 registerd">
										 <p class="tree-text">{{ $child1['username'] }}</p> 
									</div>
									</a>
									@include('accounts.referralTables.childOne')
								</div>

							@endif 

							
							
							@if( $child2 === null )

								<div class="child-right-1 blank">
										<p class="tree-text">{{ 'Blank' }}</p>
								</div>

							@elseif ($child2['status'] === 1 )
								
								
								<div class="circle-wrapper2">
									<a href="{{ URL::to('referralTree/'. $child2[ 'username' ])}}"> 
										<div class="child-right-1 activated">
											<p class="tree-text">{{ $child2['username'] }}</p> 
									</div>	
									</a>
									@include('accounts.referralTables.childTwo')
								</div>

							@else

								<div class="circle-wrapper2">
									<a href="{{ URL::to('referralTree/'. $child2[ 'username' ])}}"> 
										<div class="child-right-1 registerd">
											<p class="tree-text">{{ $child2['username'] }}</p> 
									</div>	
									</a>
									@include('accounts.referralTables.childTwo')
								</div>

							@endif 




							<div class="second-horizontal-line"></div>
							<div class="second-verticle-line"></div>

							<div class="third-horizontal-line"></div>
							<div class="third-verticle-line"></div>

							


							@if( $child3 === null )

								<div class="child-left-2l blank">
									<p class="tree-text"> {{ 'Blank' }}</p>
								</div>

							@elseif ($child3['status'] === 1 )

								<div class="circle-wrapper3">
									<a href="{{ URL::to('referralTree/'. $child3[ 'username' ])}}">
									<div class="child-left-2l activated">
										 <p class="tree-text"> {{ $child3[ 'username' ]}}</p> 
									</div>
									</a>
									@include('accounts.referralTables.childThree')
								</div>


							@else

								<div class="circle-wrapper3">
									<a href="{{ URL::to('referralTree/'. $child3[ 'username' ])}}">
									<div class="child-left-2l registerd">
										 <p class="tree-text"> {{ $child3[ 'username' ]}}</p> 
									</div>
									</a>
									@include('accounts.referralTables.childThree')
								</div>

							@endif




							@if( $child4 === null )

								<div class="child-right-2l blank">
									<p class="tree-text"> {{'Blank'}} </p>
								</div>

							@elseif ($child4['status'] === 1 )

								
									<div class="circle-wrapper4">
										<a href="{{ URL::to('referralTree/'. $child4[ 'username' ])}}">
										<div class="child-right-2l activated">
											<p class="tree-text">{{ $child4[ 'username' ]}} </p>
										</div>
										</a>
										@include('accounts.referralTables.childFour')
									</div>

							@else

								<div class="circle-wrapper4">
										<a href="{{ URL::to('referralTree/'. $child4[ 'username' ])}}">
										<div class="child-right-2l registerd">
											<p class="tree-text">{{ $child4[ 'username' ]}} </p>
										</div>
										</a>
										@include('accounts.referralTables.childFour')
									</div>


							@endif



							@if( $child5 === null )

								<div class="child-left-2r blank">
									<p class="tree-text">{{ 'Blank' }}</p>
								</div>

							@elseif ($child5['status'] === 1 )
								<div class="circle-wrapper5">
									<a href="{{ URL::to('referralTree/'. $child5[ 'username' ])}}">
										<div class="child-left-2r activated">
											<p class="tree-text">{{ $child5[ 'username' ]}} </p>
										</div>
									</a>
									@include('accounts.referralTables.childFive')
								</div>	


							@else

								<div class="circle-wrapper5">
									<a href="{{ URL::to('referralTree/'. $child5[ 'username' ])}}">
										<div class="child-left-2r registerd">
											<p class="tree-text">{{ $child5[ 'username' ]}} </p>
										</div>
									</a>
									@include('accounts.referralTables.childFive')
								</div>


							@endif





							@if( $child6 === null )

								<div class="child-right-2r blank">
									<p class="tree-text">{{ 'Blank' }}</p>
								</div>

							@elseif ($child6['status'] === 1 )
	
								<div class="circle-wrapper6">
									<a href="{{ URL::to('referralTree/'. $child6[ 'username' ])}}">
										<div class="child-right-2r activated">
											<p class="tree-text"> {{ $child6[ 'username' ]}} </p>
										</div>
									</a>
									@include('accounts.referralTables.childSix')
								</div>


							@else

								<div class="circle-wrapper6">
									<a href="{{ URL::to('referralTree/'. $child6[ 'username' ])}}">
										<div class="child-right-2r registerd">
											<p class="tree-text"> {{ $child6[ 'username' ]}} </p>
										</div>
									</a>
									@include('accounts.referralTables.childSix')
								</div>



							@endif
							
						
							
						</div> <!-- tree end -->
					
					
					
				</div>
			</div> {{-- retree end --}}
		</div>


@endsection

@section('script')
	<script type="text/javascript">
	$(document).ready(function(){

		
		




// live username search check start
		$('#search').keyup(function(){
			var name = $('#search').val();
			// alert(name);
			var host = window.location.origin;
			// alert(host);
			if($('#search').val()==''){
					$('.search-result').hide();
				}


		$.ajax({
			'url': host + "/ajaxSearch/" + name,
			'type': 'get',
			'dataType' : 'json'
		}).success(function(data){
			console.log(data);
			

			if(data === "User not found in your downline list"){
				$('.result').html('<ul class="search-result"><li style="color:red">'+data+'</li></ul>');
			}else{

				
				var name = '<ul class="search-result"><li><a id="link" href="'+host+'/referralTree/'+data[1]+'">'+data[0]+'</a></li></ul>';

				$('.result').html(name);


			}




		});
		});




	});
	</script>
@endsection
