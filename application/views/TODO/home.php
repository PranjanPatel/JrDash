<!DOCTYPE html>
<html lang="en">

<head>
  <title>Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    .row {
    margin-right: 0px;
    margin-left: 0px;
    }
    
    .table>tbody>tr>td{
      border-top: none;
      border-bottom: 1px solid black;
    }
    .todoHeader{
      height: 35px;
      margin-left: -2px;
      margin-bottom: 10px;
      background: #3F7CB1;
      line-height: 2.428571;
    }
    .todoBox{
      background: lightblue;
      height: 100%;
      border-radius: 7px;
    }
    .notesHeader{
      height: 35px;
      margin-left: -2px;
      margin-bottom: 10px;
      background: #F7F5F9;
      line-height: 2.428571;
    }
    .notesBox{
      background: lightblue;
      height: 100%;
      border-radius: 7px;
    }
    .hide{
      -moz-animation: cssAnimation 0s ease-in 5s forwards;
    /* Firefox */
    -webkit-animation: cssAnimation 0s ease-in 5s forwards;
    /* Safari and Chrome */
    -o-animation: cssAnimation 0s ease-in 5s forwards;
    /* Opera */
    animation: cssAnimation 0s ease-in 5s forwards;
    -webkit-animation-fill-mode: forwards;
    animation-fill-mode: forwards;
    }
  </style>
</head>

<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">jrDash</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Dashboard</a></li>
      <li><a href="#">User</a></li>
      <li><a href="<?php echo site_url('Login/logout'); ?>">Logout</a></li>
    </ul>
  </div>
</nav>
  <div class="container" >
    <div id="divHide" style="background: #E7F5E5;padding: 4px;display: none;">
      <ul id="popupUl">
        <li id="addTodo" style="display: none;">Added in To-do list.</li>
        <li id="markTodo" style="display: none;">Todo List Marked Completed.</li>
        <li id="addNote" style="display: none;">Added in Note list</li>
        <li id="updateNote" style="display: none;">Success</li>
      </ul>
    </div>
    <div class="col-md-6 todoBox" style="background:#4C9ED1;height: 100%;margin-top: 10px;  ">
      <div class="todoHeader">
        <strong style="color: white;margin-left: 10px;">TODO</strong>
      </div>
      <div class="row">
        <form method="post" id="todo_form">

          <div class="form-group">
            <div class="row" style="display: flex;">
              <input type="text" class="form-control" id="name" placeholder="Create New Todo Item" name="name">
              <button type="button" id="createTodo" name='createTodo' class="btn btn-success">Create</button>
            </div>
          </div>
        </form>
      </div>
      <div class="row">
        <table class="table">
          <tbody id="tbdoyTodo">
          </tbody>
        </table>
      </div>
    </div>

      <!-- ------------------------------------- Notes ------------------------- -->

      <div class="col-md-6 notesBox" style="background:#F4F2F5;height: 100%;margin-top: 10px;  ">
      <div class="notesHeader">
        <strong style="color: black;margin-left: 10px;">Notes</strong>
      </div>
      <div class="row">
        <form method="post" id="notes_form">

          <div class="form-group">
            <div class="row" style="display: flex;">
              <input type="text" class="form-control" id="title" placeholder="Note Title" name="title">
              <button type="button" id="createNotes" name='createNotes' class="btn btn-success">Create</button>
            </div>
            <div>
              <textarea rows="3" id="description" name="description" style="width: 100%;"></textarea>
            </div>
          </div>
        </form>
      </div>
      <div class="row">
        <table class="table" id="notesTable">
          <tbody id="tbdoyNotes">
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
<script>
    $(document).ready(function() {
    getData();
    getNotes();
    
  });

  $("#createTodo").click(function() {
    var form = $("#todo_form").serialize();
    $.ajax({
      url: '<?php echo base_url('home/todo_add') ?>',
      data: form,
      method: 'POST',
      success: function(data) {
        $('#success_msg').alert();
        $('#name').val('');
        $("#divHide").show().delay(2500).fadeOut();
        $("#addTodo").show().delay(2000).fadeOut();
        getData();
      },
      error: function() {
        console.log("ERROR");
      }
    });
  });

  function getData() {
    $.ajax({
      url: '<?php echo base_url('home/get_all_todoes') ?>',
      method: 'GET',
      success: function(data) {
        $('#tbdoyTodo').html(data);
      },
      error: function() {
        console.log("ERROR");
      }
    });
  }

  function deleteTodo(id) {
    $.ajax({
      url: '<?php echo base_url('home/todo_delete/') ?>' + id,
      method: 'POST',
      success: function(data) {
        getData();
      },
      error: function() {
        console.log("ERROR");
      }
    });
  }

  function updateTodo(id, isComplete) {

    $.ajax({
      url: '<?php echo base_url('home/todo_update/') ?>' + id + '/' + isComplete,
      method: 'POST',
      success: function(data) {
        getData();
        $("#divHide").show().delay(2500).fadeOut();
       $("#markTodo").show().delay(2000).fadeOut();
        
      },
      error: function() {
        console.log("ERROR");
      }
    });
  }
  function getNotes() {
    $.ajax({
      url: '<?php echo base_url('home/get_all_notes') ?>',
      method: 'GET',
      success: function(data) {
        $('#tbdoyNotes').html(data);
      },
      error: function() {
        console.log("ERROR");
      }
    });
  }
  function deleteNote(id){
    $.ajax({
      url: '<?php echo base_url('home/note_delete/') ?>' + id,
      method: 'POST',
      success: function(data) {
        getNotes();
      },
      error: function() {
        console.log("ERROR");
      }
    });
  }
  $("#createNotes").click(function() {
    var form = $("#notes_form").serialize();
    $.ajax({
      url: '<?php echo base_url('home/note_add') ?>',
      data: form,
      method: 'POST',
      success: function(data) {
        $('#success_msg').alert();
        getNotes();
        $("#divHide").show().delay(2500).fadeOut();
       $("#addNote").show().delay(2000).fadeOut();
      },
      error: function() {
        console.log("ERROR");
      }
    });
  });
  function viewDescription(id){
    $('#'+id+'DescHide').toggle();
  }
  function updateNote(id){
    $('#'+id+'Descedit').show();
  }
  function hideNoteEdit(id){
    $('#'+id+'Descedit').hide();
  }
  function saveUpdateNote(id){
    var form = $("#notes_form_edit").serialize();
    $.ajax({
      url: '<?php echo base_url('home/updateNote/') ?>'+ id,
      data: form,
      method: 'POST',
      success: function(data) {
        $('#success_msg').alert();
        $("#divHide").show().delay(2500).fadeOut();
       $("#updateNote").show().delay(2000).fadeOut();
        getNotes();

      },
      error: function() {
        console.log("ERROR");
      }
    });
  }
</script>

</html>