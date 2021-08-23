<input type="hidden"  id="hidden_id-section" name="hidden_id-section" value="{{auth()->user()->section_id}}">
<input type="hidden"  id="hidden_id-division" name="hidden_id-division" value="{{auth()->user()->division_id}}">

<input type="hidden"  id="hidden_id-NAME_RD" name="hidden_id-NAME_RD" value="  {{session('directorIV.name')}} {{session('directorIV.name_middle')}} {{session('directorIV.name_family')}}  ,{{session('directorIV.name_extension')}}||{{session('directorIV.designation')}}">
<input type="hidden"  id="hidden_id-NAME_ARD" name="hidden_id-NAME_ARD" value="  {{session('directorIII.name')}} {{session('directorIII.name_middle')}} {{session('directorIII.name_family')}}  ,{{session('directorIII.name_extension')}}||{{session('directorIII.designation')}}">
<input type="hidden"  id="hidden_id-NAME_DIVISION" name="hidden_id-NAME_DIVISION" value="  {{session('division_chief.name')}} {{session('division_chief.name_middle')}} {{session('division_chief.name_family')}}  ,{{session('division_chief.name_extension')}}||{{session('division_chief.designation')}}">
<input type="hidden"  id="hidden_id-NAME_SECTION" name="hidden_id-NAME_SECTION" value="  {{session('section_head.name')}} {{session('section_head.name_middle')}} {{session('section_head.name_family')}}  ,{{session('section_head.name_extension')}}||{{session('section_head.designation')}}">

<input type="hidden"  id="hidden_id-MY_SECTION" name="hidden_id-MY_SECTION" value="{{session('division.division_abbr')}} - {{session('section.section_abbr')}}">
