@extends('kora_app')
	<!-- BANNER -->
	@section('content')
	 @foreach( $team_name as $name)
	<div class="section subbanner" style="background:url('../images/uploads/{{ $name->flag2 }}') no-repeat center center;background-size: cover;
height: 300px;">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12">
					<div class="caption">{{ $name->name }}</div>
				</div>
			</div>
		</div>
	</div>


	<!-- ABOUT SECTION -->
	<div class="section singlepage">
		<div class="container">

			<div class="row">
				<div class="col-sm-12 col-md-12">
					<div class="page-title">
						<h2 class="lead">{{ $name->name }}</h2>

						<div class="border-style"></div>
						<div class="page-description">
							<p> {{ $name->history }} </p>
						</div>
						@endforeach
					</div>
				</div>
			</div>

			<div class="row">

				<div class="col-sm-12 col-md-12">

					<div class="team-tab" data-example-id="togglable-tabs">
						<ul id="myTabs" class="nav nav-tabs nav-tabs-team" role="tablist">
							<li class="active"><a href="#primary" id="primary-tab" role="tab" data-toggle="tab" aria-controls="primary" aria-expanded="true">الفريق الاساسى</a></li>
						</ul>
						<div id="myTabContent" class="tab-content tab-team tab-team-bg">
							<div role="tabpanel" class="tab-pane fade in active" id="primary" aria-labelledBy="primary-tab">
								<div class="teams">
									<div class="nav-team" id="primary-nav">
										    @foreach( $team_players as $player)
										      @if($player->position == 'حارس مرمى')
										<div class="position">
											<a title=""><span class="gk">{{ $player->position }}</span> {{ $player->number }}. {{ $player->Pname }}</a>
										</div>
										@elseif($player->position == 'مهاجم')
										<div class="position">
											<a title=""><span class="cf">{{ $player->position }}</span> {{ $player->number }}. {{ $player->Pname }}</a>
										</div>
										@elseif($player->position == 'مدافع')
										<div class="position">
											<a title=""><span class="cb">{{ $player->position }}</span> {{ $player->number }}. {{ $player->Pname }}</a>
										</div>
										@else
										<div class="position">
											<a title=""><span class="rmf">{{ $player->position }}</span> {{ $player->number }}. {{ $player->Pname }}</a>
										</div>
										@endif
                                              @endforeach
										<!--  -->
									</div>
								</div>
								<div class="teams-caro">
									<div id="primary-team-caro" class="owl-carousel owl-theme">
										 @foreach( $team_players as $player)
										<div class="item">
											<div class="teams-image">
												<img  src="../images/uploads/{{ $player->Pflag }}" style="width:391px; height:756px;"alt="" class="img-responsive" />
											</div>
											<div class="teams-description">
												<p><span class="title">NATIONAL : </span>{{ $player->country }}</p>
												<p><span class="title">DATE OF BIRTH : </span>{{ $player->Birth }}</p>
												<p><span class="title">HEIGHT : </span>{{ $player->height }} cm</p>
												<p><span class="title">WEIGHT : </span>{{ $player->weight }} kg</p>
												<p><span class="title">POSITION : </span>{{ $player->position }}</p>
												<p><span class="title">PLAYED : </span>*</p>
												<p><span class="title">GOAL : </span>*</p>
												<p><span class="title">RED CARDS : </span>*</p>
												<p><span class="title">YELLOW CARDS : </span>*</p>
												<p><span class="title">INFORMATION </span></p>
												<p class="font-normal">{{ $player->info }}.</p>
											</div>
										</div>
										@endforeach
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
					</div><!-- /example -->

				</div>


			</div>
		</div>
	</div>

<table class="table table--standings" data-group="Deltatre.Football.FootballEntities.GroupItem">
  <thead>
    <tr>
      <th class="table_team-won"></th>
      <th class="table_team-won">W</th>
      <th class="table_team-drawn">D</th>
      <th class="table_team-lost">L</th>
      <th class="table_team-points">Pts</th>
    </tr>
  </thead>

  <tbody>
  @foreach($team_lega as $t)
      <tr data-is-current-team="1">
        <td class="table_team-name">
          <a href="/uefaeuro/season=2016/teams/team=2/index.html" class="table_team-name_block" title="Albania">
            <span class="team-flag flag flag-ALB"></span>
            <div class="team-name">
              <span class="team-name_name">
                {{ $t->team_name }}
              </span>
            </div>
          </a>
        </td>

        <td class="table_team-won">{{ $t->winnes }}</td>
        <td class="table_team-drawn">{{ $t->draughts }}</td>
        <td class="table_team-lost">{{ $t->loses }}</td>
        <td class="table_team-points">{{ $t->points }}</td>
      </tr>
     @endforeach 
  </tbody>

</table>
	<!-- CLIENT SECTION -->
	<div class="section stat-client p-main bg-client">
		<div class="container">
			<div class="row">
      @foreach($sponsors6 as $sponsor)
        <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
          <div class="client-img">
            <a data-track="N" target="_blank" href="{{ $sponsor->url }}" title="Hyundai" class="sponsor-item-link half-link">
            <img style="width:176px;height:90px;" src="../images/uploads/{{ $sponsor->sponsor_flag }}" alt="" class="img-responsive" />
            </a>
          </div>
        </div>
        @endforeach

			</div>
		</div>
	</div>
@endsection