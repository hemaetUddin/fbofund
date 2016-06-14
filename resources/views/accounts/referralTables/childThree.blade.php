{{-- table start --}}
	
	<div class="child3">
		<table class="tableDesign">
			<tr>
				<td> Full Name </td>
				<td colspan="2">
					{{ $child3['full_name']}} 
				</td>
			</tr>

			<tr>
				<td colspan="2">Referrar ID: </td>
				<td> {{ ReferralTableValues::referrarId( $child3['referrar_id'] )}} </td>
			</tr>
			<tr>
				<td colspan="2"> Upline ID: </td>
				<td> {{ ReferralTableValues::uplineId( $child3['upline_id'] )}} </td>
			</tr>
			<tr>
				<td></td>
				<td>Left Position</td>
				<td>Right Position</td>
			</tr>

			<tr>
				<td> Members: </td>
				<td> {!! ReferralTableValues::leftMemThree($child1['id']) !!} </td>
				<td> {!! ReferralTableValues::rightMemThree($child1['id']) !!} </td>
			</tr>

			<tr>
				<td>Carry: </td>
				<td> {{ ReferralTableValues::getCarryLeft( $child3['id'] ) }} </td>
				<td> {{ ReferralTableValues::getCarryRight( $child3['id'] ) }}</td>
			</tr>
			<tr>
				<td colspan="3">Joining Date: &nbsp; {{ date('Y-m-d', strtotime( $child3['signup_date'] ))}} </td>
				<td></td>
			</tr>
		</table>
	</div>
{{-- table end --}}