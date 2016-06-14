{{-- table start --}}
	
	<div class="child2">
		<table class="tableDesign">
			<tr>
				<td> Full Name </td>
				<td colspan="2">
					{{ $child2['full_name']}} 
				</td>
			</tr>

			<tr>
				<td colspan="2">Referrar ID: </td>
				<td> {{ ReferralTableValues::referrarId( $child2['referrar_id'] )}} </td>
			</tr>
			<tr>
				<td colspan="2"> Upline ID: </td>
				<td> {{ ReferralTableValues::uplineId( $child2['upline_id'] )}} </td>
			</tr>
			<tr>
				<td></td>
				<td>Left Position</td>
				<td>Right Position</td>
			</tr>

			<tr>
				<td> Members: </td>
				<td> {!! ReferralTableValues::leftMemTwo($child2['id']) !!} </td>
				<td> {!! ReferralTableValues::rightMemTwo($child2['id']) !!} </td>
			</tr>
			<tr>
				<td>Carry: </td>
				<td> {{ ReferralTableValues::getCarryLeft( $child2['id'] ) }} </td>
				<td> {{ ReferralTableValues::getCarryRight( $child2['id'] ) }}</td>
			</tr>
			<tr>
				<td colspan="3">Joining Date: &nbsp; {{ date('Y-m-d', strtotime( $child2['signup_date'] ))}} </td>
				<td></td>
			</tr>
		</table>
	</div>
{{-- table end --}}