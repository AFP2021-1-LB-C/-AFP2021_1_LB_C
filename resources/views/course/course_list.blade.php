<?php use App\Models\Courses_user;use App\Models\Course;?>
@include('layout.header')
<?php $subbed = false; ?>
<table class="table">
  <thead class="table-secondary">
  <tr>
    <th>Azonosító</th>
    <th>Kurzus neve</th>
    <th>Kurzus leírása</th>
    <th>Részletes leírás</th>
    <th>Oktató</th>
    @if($isAdmin||$isTeacher)
    <th>Láthatóság</th>
    @endif
    <th>Műveletek</th>
    @if($isAdmin||$isTeacher)
    <th>Hallgatók</th>
    @endif
    @if($isStudent)
    <th>Jelentkezés</th>
    @endif
  </tr>
</thead>
<tbody>
  @foreach ($items as $item)
  @if (($item -> deleted_at) == NULL)
  @inject('logged', 'App\Http\Controllers\Controller')
  @if (!$isTeacher && ($item -> status) == 1 || $isAdmin 
  || ($isTeacher && $item -> teacher_id == $logged->auth('id')))
  <tr>
    <td>{{$item -> id}}</td>
    <td>{{$item -> name}}</td> 
    <td>{{$item -> description}}</td>
    <td>
      <button id="myBtn-{{$item -> id}}" class="modalButton"><div class="arrow-right"></div></button>
      <div id="myModal-{{$item -> id}}"  class="modal">
        <!-- Modal content -->
        <div class="modal-content">
          <span id="close-{{$item -> id}}" class="close">&times;</span>
          <div class="modal__inner-content">

          {{$item -> longDescription}}
        </div>
        </div>
      </div>
    </td>
<?php try { ?>
    <td>{{$item -> teacher -> name}}</td>
<?php } catch (Exception $ex) { ?>
    -
<?php } ?>
    @if($isAdmin||$isTeacher)
      @if(($item -> status) == 0)
        <td><img class="me-3" style="position: relative; left:30px;" src="/images/locked_icon.png" alt="" width="20" height="20"></td>
      @else
        <td><img class="me-3" style="position: relative; left:30px;" src="/images/published_icon.png" alt="" width="20" height="20"></td>
      @endif
    @endif
    <td>
    @if($isAdmin||$isTeacher)
    <a href="/admin/course/edit/{{$item -> id}}">Szerkesztés</a>
    <a href="/admin/course/delete/{{$item -> id}}">Törlés</a>
    <td>
    <a href="/admin/course/students/{{$item -> id}}">Megtekintés</a>
    </td>
    @endif
    @if (!$isAdmin && !$isTeacher)
    @inject('logged', 'App\Http\Controllers\Controller')
    <?php
    $status = Courses_user::where('course_id',($item -> id))
    ->where('user_id',($logged->auth('id')))
    ->select('courses_users.*')
    ->value('status');
    ?>
   <?php $subbed = false ?>
    @foreach ($subs as $sub)
        @if (($sub -> user_id) == ($logged->auth('id')) &&
         ($item -> id) == ($sub -> course_id))
          <?php $subbed = true; ?>
          @if($subbed && $status != -1)
    <a href="/course/unsubscribe/{{$sub -> id}}">Leadás</a>
          @endif
          @endif
    @endforeach
   @if($subbed)
    <a href="/course/{{$item -> id}}">Megtekintés</a>
    @elseif ($logged->auth('id') != null)
    <a href="/course/subscribe/{{$item -> id}}">Jelentkezés</a>
    @endif
    @endif
    </td>
  @if($isStudent)
    @if(!$subbed)
    <td>-</td>
    @elseif($status == -1)
    <td>Elutasítva</td>
    @elseif($status == 1)
    <td>Elfogadva</td>
    @elseif($status == 0)
    <td>Várakozás</td>
    @endif
  @endif
  </tr>
  @endif
  @endif
  @endforeach

</tbody>
</table>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    $(".modal").each(function(){
      var modal = document.getElementById($(this).attr("id"));
      var btn = document.getElementById($(this).parent().find("button").attr("id"));
      var close = document.getElementById($(this).find(".close").attr("id"));
      btn.onclick = function() {
        modal.style.display = "block";
      }
      close.onclick = function() {
        modal.style.display = "none";
      }
      window.onclick = function(event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
      }
    })
  });
</script>
<style>
  body {font-family: Arial, Helvetica, sans-serif;}
  
  /* The Modal (background) */
  .modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  }
  
  /* Modal Content */
  .modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
  }
  .modal__inner-content{
    padding: 30px;
  }
  .modalButton{
        border: none;
    background: none;
  }

  /* The Close Button */
  .close {
    text-align: right;
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
  }
  
  .close:hover,
  .close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
  }
  .arrow-right {
  width: 0; 
  height: 0; 
  border-top: 30px solid transparent;
  border-bottom: 30px solid transparent;
  border-left: 30px solid green;
}
  </style>

@include('layout.footer')
