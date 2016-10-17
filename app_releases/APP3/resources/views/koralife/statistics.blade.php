@extends('kora_app')
@section('styles')
  <link rel='stylesheet' href="{{ asset('/admin-ui/css/statisitcs.css') }}">
  <link rel='stylesheet' href="{{ asset('/admin-ui/css/match.css') }}">
  <link rel='stylesheet' href="{{ asset('/admin-ui/css/matchbox.css') }}">
  @endsection

@section('content')

      <!-- //////////////////////////////Statisitcs//////////////////////////////// -->
  <div class="grid_8" style="margin-left: 24% !important;">
  <div class="row">
  <div style="" class="box matchstats postmatch">
  <div class="bH">
  <h3 class="medTitle" style="text-align: right;">احصائيات</h3> 
   </div>
   <div class="bC">
   <div class="castrolMtStatHead">
   @foreach($matchteams as $mteam)
   <div class="fl hLogo">
   <img alt="" title="Liverpool" src="../images/uploads/{{ $mteam->T1flag }}" height="30" width="30"> 
   </div>

   <div class="fl nameCont">
   
   <div class="hName">{{ $mteam->T1name }}</div>
   <div class="aName">{{ $mteam->T2name }}</div>
   </div>

   <div class="fr aLogo">
   <img alt="" title="Sevilla" src="../images/uploads/{{ $mteam->T2flag }}" height="30" width="30">
  </div>
     @endforeach
   </div>


   <table class="castrolMtStat">
   <tbody>
   <tr>
   <td class="barContTdL">
   <div class="barContL">
   <div class="bar"><div class="barTailL tmTailLeft tmTailLeft7889"> </div>
   <div class="barBodyL tmBodyL tmBody7889" style="width:21.5%;"> </div><div class="barHeadL tmHeadLeft tmHeadLeft7889"> </div></div> 
   </div>
   </td>
   <td>
   <table>
   <tbody>
   <tr><td class="statsLblTopLeft"> </td>
   <td class="statsLblTop"> </td><td class="statsLblTopRight"> </td>
   </tr>
   <tr>
   <td class="statsLblLeft"> </td>
   <td>
   <table>
   <tbody>
   <tr>
   @foreach($goals as $goal)
   <td class="valueL">
   <div class="valContL tmTailLeft tmTailLeft7889">
   <p class="barNumber">{{ $goal->team1_goals }}</p>
   </div>
   </td>
   <td class="statName"><img style="margin-top: -10px;" width="20px" height="20px" src="{{ asset('/admin-ui/images/soccer.png')}}"></td>
   <td class="valueR">
   <div class="valContR tmTailRight tmTailRight52714">
   <p class="barNumber">{{ $goal->team2_goals }}</p>
   </div>
   </td>
   @endforeach
   </tr>
   </tbody>
   </table>
   </td>
   <td class="statsLblRight"> </td>
   </tr><tr><td class="statsLblBottomLeft"> </td>
   <td class="statsLblBottom"> </td><td class="statsLblBottomRight"> </td>
   </tr>
   </tbody>
   </table>


   </td>

   <td class="barContTdR">
   <div class="barContR"><div class="bar"><div class="barTailR c"> </div><div class="barBodyR tmBodyR tmBody52714" style="width:71.5%;"> </div><div class="barHeadR tmHeadRight tmHeadRight52714"> </div>
   </div> </div>
   </td>
   </tr>

   
   <tr><td class="statsLblBottomLeft"> </td>
   <td class="statsLblBottom"> </td><td class="statsLblBottomRight"> 
</td></tr>
</tbody>
   </table>

   <table class="castrolMtStat">
   <tbody>
   <tr>
   <td class="barContTdL">
   <div class="barContL">
   <div class="bar"><div class="barTailL tmTailLeft tmTailLeft7889"> </div>
   <div class="barBodyL tmBodyL tmBody7889" style="width:21.5%;"> </div><div class="barHeadL tmHeadLeft tmHeadLeft7889"> </div></div> 
   </div>
   </td>
   <td>
   <table>
   <tbody>
   <tr><td class="statsLblTopLeft"> </td>
   <td class="statsLblTop"> </td><td class="statsLblTopRight"> </td>
   </tr>
   <tr>
   <td class="statsLblLeft"> </td>
   <td>
   <table>
   <tbody>
   <tr>
      @foreach($offsides as $offside)
   <td class="valueL"><div class="valContL tmTailLeft tmTailLeft7889">
   <p class="barNumber">{{ $offside->team1_offsides }}</p></div>
   </td><td class="statName"><img style="margin-top: -10px;" width="20px" height="20px" src="{{ asset('/admin-ui/images/Untitled.jpg')}}"></td>
   <td class="valueR"><div class="valContR tmTailRight tmTailRight52714">
   <p class="barNumber">{{ $offside->team2_offsides }}</p></div></td>
   @endforeach
   </tr>
   </tbody>
   </table>
   </td>
   <td class="statsLblRight"> </td>
   </tr><tr><td class="statsLblBottomLeft"> </td>
   <td class="statsLblBottom"> </td><td class="statsLblBottomRight"> </td>
   </tr>
   </tbody>
   </table>


   </td>

   <td class="barContTdR">
   <div class="barContR"><div class="bar"><div class="barTailR c"> </div><div class="barBodyR tmBodyR tmBody52714" style="width:71.5%;"> </div><div class="barHeadR tmHeadRight tmHeadRight52714"> </div>
   </div> </div>
   </td>
   </tr>

   
   <tr><td class="statsLblBottomLeft"> </td>
   <td class="statsLblBottom"> </td><td class="statsLblBottomRight"> 
</td></tr>
</tbody>
   </table>
   


      

      <table class="castrolMtStat">
   <tbody>
   <tr>
   <td class="barContTdL">
   <div class="barContL">
   <div class="bar"><div class="barTailL tmTailLeft tmTailLeft7889"> </div>
   <div class="barBodyL tmBodyL tmBody7889" style="width:21.5%;"> </div><div class="barHeadL tmHeadLeft tmHeadLeft7889"> </div></div> 
   </div>
   </td>
   <td>
   <table>
   <tbody>
   <tr><td class="statsLblTopLeft"> </td>
   <td class="statsLblTop"> </td><td class="statsLblTopRight"> </td>
   </tr>
   <tr>
   <td class="statsLblLeft"> </td>
   <td>
   <table>
   <tbody>
      <tr>
 @foreach($errors as $error)
   <td class="valueL"><div class="valContL tmTailLeft tmTailLeft7889">
   <p class="barNumber">{{ $error->team1_errors }}</p></div>
   </td><td class="statName"><img style="margin-top: -10px;" width="20px" height="20px" src="{{ asset('/admin-ui/images/Warning.png')}}"></td>
   <td class="valueR"><div class="valContR tmTailRight tmTailRight52714">
   <p class="barNumber">{{ $error->team2_errors }}</p></div></td>
   @endforeach
   </tr>   
   </tbody>
   </table>
   </td>
   <td class="statsLblRight"> </td>
   </tr><tr><td class="statsLblBottomLeft"> </td>
   <td class="statsLblBottom"> </td><td class="statsLblBottomRight"> </td>
   </tr>
   </tbody>
   </table>


   </td>

   <td class="barContTdR">
   <div class="barContR"><div class="bar"><div class="barTailR c"> </div><div class="barBodyR tmBodyR tmBody52714" style="width:71.5%;"> </div><div class="barHeadR tmHeadRight tmHeadRight52714"> </div>
   </div> </div>
   </td>
   </tr>

   
   <tr><td class="statsLblBottomLeft"> </td>
   <td class="statsLblBottom"> </td><td class="statsLblBottomRight"> 
</td></tr>
</tbody>
   </table>

      <table class="castrolMtStat">
   <tbody>
   <tr>
   <td class="barContTdL">
   <div class="barContL">
   <div class="bar"><div class="barTailL tmTailLeft tmTailLeft7889"> </div>
   <div class="barBodyL tmBodyL tmBody7889" style="width:21.5%;"> </div><div class="barHeadL tmHeadLeft tmHeadLeft7889"> </div></div> 
   </div>
   </td>
   <td>
   <table>
   <tbody>
   <tr><td class="statsLblTopLeft"> </td>
   <td class="statsLblTop"> </td><td class="statsLblTopRight"> </td>
   </tr>
   <tr>
   <td class="statsLblLeft"> </td>
   <td>
   <table>
   <tbody>
      <tr>
 
   <td class="valueL"><div class="valContL tmTailLeft tmTailLeft7889">
   <p class="barNumber">{{ $red1cards }}</p></div>
   </td><td class="statName"><img style="margin-top: -10px;" width="20px" height="20px" src="{{ asset('/admin-ui/images/2000px-Red_card.svg.png')}}"></td>
   <td class="valueR"><div class="valContR tmTailRight tmTailRight52714">
   <p class="barNumber">{{ $red2cards }}</p></div></td>
   
   </tr>   
   </tbody>
   </table>
   </td>
   <td class="statsLblRight"> </td>
   </tr><tr><td class="statsLblBottomLeft"> </td>
   <td class="statsLblBottom"> </td><td class="statsLblBottomRight"> </td>
   </tr>
   </tbody>
   </table>


   </td>

   <td class="barContTdR">
   <div class="barContR"><div class="bar"><div class="barTailR c"> </div><div class="barBodyR tmBodyR tmBody52714" style="width:71.5%;"> </div><div class="barHeadR tmHeadRight tmHeadRight52714"> </div>
   </div> </div>
   </td>
   </tr>

   
   <tr><td class="statsLblBottomLeft"> </td>
   <td class="statsLblBottom"> </td><td class="statsLblBottomRight"> 
</td></tr>
</tbody>
   </table>

      <table class="castrolMtStat">
   <tbody>
   <tr>
   <td class="barContTdL">
   <div class="barContL">
   <div class="bar"><div class="barTailL tmTailLeft tmTailLeft7889"> </div>
   <div class="barBodyL tmBodyL tmBody7889" style="width:21.5%;"> </div><div class="barHeadL tmHeadLeft tmHeadLeft7889"> </div></div> 
   </div>
   </td>
   <td>
   <table>
   <tbody>
   <tr><td class="statsLblTopLeft"> </td>
   <td class="statsLblTop"> </td><td class="statsLblTopRight"> </td>
   </tr>
   <tr>
   <td class="statsLblLeft"> </td>
   <td>
   <table>
   <tbody>
   <tr>
   <td class="valueL"><div class="valContL tmTailLeft tmTailLeft7889">
   <p class="barNumber">{{ $yellow1cards }}</p></div>
   </td><td class="statName"><img style="margin-top: -10px;" width="20px" height="20px" src="{{ asset('/admin-ui/images/2000px-Yellow_card.svg.png')}}"></td>
   <td class="valueR"><div class="valContR tmTailRight tmTailRight52714"><p class="barNumber">{{ $yellow2cards }}</p></div></td>
   </tr>
   </tbody>
   </table>
   </td>
   <td class="statsLblRight"> </td>
   </tr><tr><td class="statsLblBottomLeft"> </td>
   <td class="statsLblBottom"> </td><td class="statsLblBottomRight"> </td>
   </tr>
   </tbody>
   </table>


   </td>

   <td class="barContTdR">
   <div class="barContR"><div class="bar"><div class="barTailR c"> </div><div class="barBodyR tmBodyR tmBody52714" style="width:71.5%;"> </div><div class="barHeadR tmHeadRight tmHeadRight52714"> </div>
   </div> </div>
   </td>
   </tr>

   
   <tr><td class="statsLblBottomLeft"> </td>
   <td class="statsLblBottom"> </td><td class="statsLblBottomRight"> 
</td></tr>
</tbody>
   </table>

   <table class="castrolMtStat">
   <tbody>
   <tr>
   <td class="barContTdL">
   <div class="barContL">
   <div class="bar"><div class="barTailL tmTailLeft tmTailLeft7889"> </div>
   <div class="barBodyL tmBodyL tmBody7889" style="width:21.5%;"> </div><div class="barHeadL tmHeadLeft tmHeadLeft7889"> </div></div> 
   </div>
   </td>
   <td>
   <table>
   <tbody>
   <tr><td class="statsLblTopLeft"> </td>
   <td class="statsLblTop"> </td><td class="statsLblTopRight"> </td>
   </tr>
   <tr>
   <td class="statsLblLeft"> </td>
   <td>
   <table>
   <tbody>
     <tr>
 @foreach($psessions as $psession)
   <td class="valueL"><div class="valContL tmTailLeft tmTailLeft7889">
   <p class="barNumber">{{ $psession->team1_psessions }}%</p></div>
   </td><td class="statName">الأستحواذ</td>
   <td class="valueR"><div class="valContR tmTailRight tmTailRight52714">
   <p class="barNumber">{{ $psession->team2_psessions }}%</p></div></td>
   @endforeach
   </tr>
   </tbody>
   </table>
   </td>
   <td class="statsLblRight"> </td>
   </tr><tr><td class="statsLblBottomLeft"> </td>
   <td class="statsLblBottom"> </td><td class="statsLblBottomRight"> </td>
   </tr>
   </tbody>
   </table>


   </td>

   <td class="barContTdR">
   <div class="barContR"><div class="bar"><div class="barTailR c"> </div><div class="barBodyR tmBodyR tmBody52714" style="width:71.5%;"> </div><div class="barHeadR tmHeadRight tmHeadRight52714"> </div>
   </div> </div>
   </td>
   </tr>

   
   <tr><td class="statsLblBottomLeft"> </td>
   <td class="statsLblBottom"> </td><td class="statsLblBottomRight"> 
</td></tr>
</tbody>
   </table>

         <table class="castrolMtStat">
   <tbody>
   <tr>
   <td class="barContTdL">
   <div class="barContL">
   <div class="bar"><div class="barTailL tmTailLeft tmTailLeft7889"> </div>
   <div class="barBodyL tmBodyL tmBody7889" style="width:21.5%;"> </div><div class="barHeadL tmHeadLeft tmHeadLeft7889"> </div></div> 
   </div>
   </td>
   <td>


   <table>
   <tbody>
   <tr><td class="statsLblTopLeft"> </td>
   <td class="statsLblTop"> </td><td class="statsLblTopRight"> </td>
   </tr>
   <tr>
   <td class="statsLblLeft"> </td>
   <td>
   <table>
   <tbody>
   <tr>
 @foreach($corners as $corner)
   <td class="valueL"><div class="valContL tmTailLeft tmTailLeft7889">
   <p class="barNumber">{{ $corner->team1_corners }}</p></div>
   </td><td class="statName">الركنيات</td>
   <td class="valueR"><div class="valContR tmTailRight tmTailRight52714">
   <p class="barNumber">{{ $corner->team2_corners }}</p></div></td>
   @endforeach
   </tr>
   </tbody>
   </table>
   </td>
   <td class="statsLblRight"> </td>
   </tr><tr><td class="statsLblBottomLeft"> </td>
   <td class="statsLblBottom"> </td><td class="statsLblBottomRight"> </td>
   </tr>
   </tbody>
   </table>


   </td>

   <td class="barContTdR">
   <div class="barContR"><div class="bar"><div class="barTailR c"> </div><div class="barBodyR tmBodyR tmBody52714" style="width:71.5%;"> </div><div class="barHeadR tmHeadRight tmHeadRight52714"> </div>
   </div> </div>
   </td>
   </tr>

   
   <tr><td class="statsLblBottomLeft"> </td>
   <td class="statsLblBottom"> </td><td class="statsLblBottomRight"> 
</td></tr>
</tbody>
   </table>

    </div>
   </div>
    </div> 
    </div>

  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
 <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
 <br>
 <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>

  <br>

@endsection
@section('scripts')
@endsection