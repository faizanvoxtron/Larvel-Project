@extends('layouts.admin.app')
@section('page_header')
Chats
@endsection

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" />
<style> .con-t{ padding:0; background-color: #FFF; box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
    height: 700px; position: relative; } .con-t .row{ padding: 0 !important;     margin-right: -84px !important; } .menu { float: left; height: 700px;;
    width: 70px; background: #4768b5; background: -webkit-linear-gradient(#4768b5, #35488e); background:
    -o-linear-gradient(#4768b5, #35488e); background: -moz-linear-gradient(#4768b5, #35488e); background:
    linear-gradient(#4768b5, #35488e); box-shadow: 0 10px 20px rgba(0,0,0,0.19); padding: 0; } .menu .items {
    list-style:none; margin: auto; padding: 0; } .menu .items .item { height: 70px; border-bottom: 1px solid #6780cc;
    display:flex; justify-content: center; align-items: center; color: #9fb5ef; font-size: 17pt; } .menu .items
    .item-active { background-color:#5172c3; color: #FFF; } .menu .items .item:hover { cursor: pointer;
    background-color: #4f6ebd; color: #cfe5ff; } /*===CONVERSATIONS===*/ .discussions {    background: #1e3a5fe0 !important; width: 35%; height: 700px;
    box-shadow: 0px 8px 10px rgba(0,0,0,0.20); overflow: hidden; background-color: #ccc; display: inline-block; padding:
    0; } .discussions .discussion { width: 100%; height: 90px; background-color: #FAFAFA; border-bottom: solid 1px
    #E0E0E0; display:flex; align-items: center; cursor: pointer; } .discussions .search { display:flex; align-items:
    center; justify-content: center; color: #E0E0E0; } .discussions .search .searchbar { height: 40px; /*
    background-color: #FFF; */ width: 70%; padding: 0 20px; border-radius: 50px; /* border: 1px solid #EEEEEE; */
    display:flex; align-items: center; cursor: pointer; } .discussions .search .searchbar input { margin-left: 15px;
    height:38px; width:100%; border:none; font-family: 'Montserrat' , sans-serif;; } .discussions .search .searchbar
    *::-webkit-input-placeholder { color: #E0E0E0; } .discussions .search .searchbar input *:-moz-placeholder { color:
    #E0E0E0; } .discussions .search .searchbar input *::-moz-placeholder { color: #E0E0E0; } .discussions .search
    .searchbar input *:-ms-input-placeholder { color: #E0E0E0; } 
    .discussions .message-active {     
    margin-left: 18px;
    margin-top: 6px;
    border-radius: 8px;
    max-width: 95%;
    height: 90px;
    background-color: #FFF;
    border-bottom: solid 1px #E0E0E0; 
} .discussions .discussion .photo {
    margin-left:20px; display: block; width: 45px; height: 45px; -moz-border-radius: 50px; -webkit-border-radius: 50px;
    background-position: center; background-size: cover; background-repeat: no-repeat; } .online { position: relative;
    top: 30px; left: 35px; width: 13px; height: 13px; background-color: #8BC34A; border-radius: 13px; border: 3px solid
    #FAFAFA; } .desc-contact { height: 43px; width:50%; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    } .discussions .discussion .name { margin: 0 0 0 20px; font-family:'Montserrat', sans-serif; font-size: 12pt;
    color:#515151; } .discussions .discussion .message { margin: 6px 0 0 20px; font-family:'Montserrat', sans-serif;
    font-size: 9pt; color:#515151; } .timer { margin-left: 15%; font-family:'Open Sans', sans-serif; font-size: 11px;
    padding: 3px 8px; color: #BBB; background-color: #FFF; border: 1px solid #E5E5E5; border-radius: 15px; } .chat {
    width: calc(65% - 85px); padding: 0; } .header-chat {     background-color: #a4dce3;
    height: 74px; box-shadow: 0px 3px 2px
    rgba(0,0,0,0.100); display:flex; align-items: center; } .chat .header-chat .icon { margin-left: 30px; color:#515151;
    font-size: 14pt; } .chat .header-chat .name { margin: 0 0 0 20px; text-transform: uppercase;
    font-family:'Montserrat', sans-serif; font-size: 13pt; color:#515151; } .chat .header-chat .right { position:
    absolute; right: 40px; } .chat .messages-chat { padding: 25px 35px; overflow-y: auto; height: 528px; } .chat
    .messages-chat .message { display:flex; align-items: center; margin-bottom: 8px; } #typing{ margin-top: -26px;
    margin-left: 10px; } .chat .messages-chat .message .photo { display: block; width: 45px; height: 45px;
    -moz-border-radius: 50px; -webkit-border-radius: 50px; background-position: center; background-size: cover;
    background-repeat: no-repeat; } .chat .messages-chat .text { margin: 0 35px; background-color: #f6f6f6;
    border-radius: 12px; font-weight: 400; font-size: 16px;} .my_time{ text-align: right !important; margin-right: 45px !important; } .text-only {
    margin-left: 45px; } .readed{ color: rgb(0, 117, 206); } .time { font-size: 10px; color:lightgrey;
    margin-bottom:10px; margin-left: 85px; } .response-time { float: right; margin-right: 40px !important; } .response {
    float: right; margin-right: 0px !important; margin-left:auto; /* flexbox alignment rule */ } .response .text {
    background-color: #e3effd !important; } .footer-chat { width: calc(65% - 66px); height: 80px; display:flex;
    align-items: center; position:absolute; bottom: 0; background-color: transparent; border-top: 2px solid #EEE; }
    .chat .footer-chat .icon { margin-left: 30px; color:#C0C0C0; font-size: 14pt; } .chat .footer-chat .send {
    color:#fff; background-color: #4f6ebd; position: absolute; right: 50px; padding: 12px 12px 12px 12px; border-radius:
    50px; font-size: 14pt; } .chat .footer-chat .name { margin: 0 0 0 20px; text-transform: uppercase;
    font-family:'Montserrat', sans-serif; font-size: 13pt; color:#515151; } .chat .footer-chat .right { position:
    absolute; right: 40px; } .write-message { border-radius: 6px;
    border: 2px solid #7fd9e4;
    width: 75%; height: 50px; margin-left: 20px;
    padding: 10px; } .footer-chat *::-webkit-input-placeholder { color: #C0C0C0; font-size: 13pt; } .footer-chat input
    *:-moz-placeholder { color: #C0C0C0; font-size: 13pt; } .footer-chat input *::-moz-placeholder { color: #C0C0C0;
    font-size: 13pt; margin-left:5px; } .footer-chat input *:-ms-input-placeholder { color: #C0C0C0; font-size: 13pt; }
    .clickable { cursor: pointer; } 
    .modal-header .close {
    border-radius: 5px;
    padding: 0px 4px 2px 4px !important;
    margin: -8px -5px !important;
    background: #ff0018;
    }
    button.newChat {
        width: 100%;
        height: 67px;
        border: none;
        background: transparent;
    }
    .imageInsert {
        cursor: pointer;
        display: inline;
        padding-left: 24px;
    }
    .discussion-container {
    overflow-y: scroll;
    height: 567px;
}
.discussion-container::-webkit-scrollbar-thumb:hover {
    background: #ccc;
}
.discussion-container::-webkit-scrollbar-thumb {
    width: 8px;
    background: black;
}
.discussion-container::-webkit-scrollbar {
    width: 8px;
}
.overlay {
    display: none;
    position: absolute;
    width: 100%;
    height: 100%;
    background: #00000080;
}
.icon-chat{
    width: 55px;
    height: 52px;
    border-radius: 100%;
    border: 1px solid #0000005e;
    padding: 3px;
    margin-left: 35px;
}
.no-chat{
    text-align: center;
    font-size: 16px;
    font-weight: 500;
    background: #cccccc2b;
    border-radius: 15px;
    padding: 11px 0px;
}
.discussion.message-active:hover {
    background: #ccc;
    transition: .2s ease-in-out;
}
.new-chat-img {
    width: 50px;
    height: 50px;
    border-radius: 100%;
    margin-right: 20px;
}
.new-chat-user-div {
    border-bottom: 1px solid #ccc;
    padding: 12px 5px;
}
.new-chat-user-div:hover{
    background: #ddd;
    transition: .4s;
    border-radius: 6px;
    cursor: pointer;
}
.photo-with-message{
    display: block;
    width: 45px;
    height: 45px;
    -moz-border-radius: 50px;
    -webkit-border-radius: 50px;
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
}
.media-message{
    margin-left: 82px;
    border-radius: 5px;
    margin-bottom: 8px;
    width: 200px;
    height: 250px;
}
.modal-open .modal {
    background: #000000a1;
}
input.chat-search {
    height: 49px;
    width: 100%;
    padding-left: 20px;
    background-color: #fafafa;
    border: 2px solid #ccc;
    border-radius: 5px;
}
.chat-search-div {
    padding-left: 16px;
    padding-right: 1px;
}
.search-lists{
    display: none;
}
.search-img{
    height: 49px;
    width: 45px;
    border-radius: 100%;
    margin: 8px 19px -5px 13px;
}
.search-name{
    color: #000;
}
.badge{
    background: #a4dce3;
}
.nav-link{
    font-weight: 500;
    color: #000;
}
.nav-link:hover, .nav-link:active,.nav-link:focus{
    font-weight: 500;
    color: #000;
}
.chat .messages-chat::-webkit-scrollbar {
    width: 6px; 
}

.chat .messages-chat::-webkit-scrollbar-thumb {
    background: #1e3a5f !important;
}

.chat .messages-chat::-webkit-scrollbar-thumb:hover {
    background: #555;
}
ul{
    margin-bottom: 0;
}
.create_chat_with{
    padding-bottom: 10px;
    background: #fff;
}
    </style>
@endpush @section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <div class="con-t">
        <div class="row"> <!-- NEW CHAT Modal -->
        <div class="overlay"></div>
            <div class="modal fade" id="newChatModal" tabindex="-1" role="dialog" aria-labelledby="newChatModal"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Start New Chat With</h5> <button
                                type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                                    aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body new_chat_users_div" style="text-align:center;"></div>
                    </div>
                </div>
            </div>
            <section class="discussions">
                <div class="chat-search-div">
                    <input type="search" placeholder="Search Here" class="chat-search" name="" id="chat-search">
                    <ul id="search-lists" class="search-lists">
                        
                    </ul>
                </div>
                <div class="discussion search">
                    <div class="searchbar">
                        <button class="newChat">Start Chat <i class="fa-solid fa-circle-plus fa-lg" style="color: #5dea5f;"></i></button>
                    </div>
                </div>
                @if(Auth::user()->role_id == 1)
                <ul class="nav nav-tabs" id="myTab" style="margin-left: 18px" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">My Chats</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">All Chats</a>
                    </li>
                </ul>
                @endif
                <div class="discussion-container">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        </div>
                        <div class="tab-pane fade " id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        </div>
                    </div>
                </div>
                @if(Auth::user()->role_id != 1)
                <div class="discussion-container">
                </div>
                @endif
            </section>
            <section class="chat">
                <div class="header-chat">
                    <div class="img-chat"></div>
                    <!-- <i class="icon fa fa-user-o" aria-hidden="true"></i> -->
                    <p class="name"></p>
                    <p class="badge"></p>
                </div>
                <div class="messages-chat" id="container-message">
                    <div class="message text-only">
                        <div class="response">
                            <p class="text"></p>
                        </div>
                    </div>
                    <p class="time my_time"><i class=""></i></p>
                    <div class="message">
                        <div class="photo">
                            <!-- <div class="online"></div> -->
                        </div>
                        <p class="text"></p>
                    </div>
                    <p class="time"></p>
                </div>
                <p id="typing"></p>
                <div class="footer-chat">
                    <form class="w-100" id="form" enctype="multipart/form-data">
                        <div class="imageInsert"><i class="fa-solid fa-image"></i></i></div>
                        <input type="text" class="write-message" id="input-message"
                            placeholder="Select chat or create a new one" disabled >
                        <input type="text" id="touserId" value="{{isset($id)?$id->id:'1'}}" hidden>
                        <input type="text" hidden id="room-id" value="{{$room_id}}">
                        <input type="submit" hidden>
                        <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModal"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Insert File</h5> <button
                                            type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                                                aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <input type="file" id="file" class="dropify" data-allowed-file-extensions="pdf png jpg jpeg xls mp4 csv" data-max-file-size="10M">
                                </div>
                            </div>
                        </div>
                    </form>
                    <i class="icon send fa-solid fa-paper-plane clickable" id="send-btn"></i>
                </div>
            </section>
        </div>
    </div>

    @endsection

    @push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script type="module">
        $('#chat-search').on('input', function () {
            var query = $(this).val();
            $.ajax({
                url: `{{route('chat.search')}}`,
                method: 'GET',
                data: {query: query},
                success: function (data) {
                    searchList(data.lists)
                },
                error: function (error) {
                    alert(data.message)
                }
            });
        });
        $('body').click(function(){
            $(".overlay").css('display','none')
        })
        $('.dropify').dropify();
        $(".imageInsert").click(function() {
            $('#imageModal').modal('show');
            $('.close').modal('hide');
        });
        var initialData;
        let userId;
        document.addEventListener("DOMContentLoaded", function() {
            if({{Auth::user()->role_id}} == 1){
                $.ajax({
                    type: 'GET',
                    url:"{{route('all.list')}}",
                    success: function(data) {
                        if (data.success) {
                            getAllChats(data.list)
                        } else if(data.success) {
                            alert("Failed to start the chat. Please try again.");
                        }
                    },
                    error: function(data) {
                        alert(data.error);
                    }
                });
                $.ajax({
                type: 'GET',
                url: "{{route('admin.mylist')}}",
                    success:function(data) {
                        if(data.success){
                            getLists(data.lists)
                        }else if(data.success){
                            alert("Failed to start a chat");
                        }
                    }
                })
            }else{
                $.ajax({
                    type: 'GET',
                    url:"{{route('list',[Auth::user()->id])}}",
                    success: function(data) {
                        if (data.success) {
                            getLists(data.lists)
                        } else if(data.success) {
                            alert("Failed to start the chat. Please try again.");
                        }
                    },
                    error: function(data) {
                        alert(data.error);
                    }
                });
            }
        });
        function getAllChats(lists){
            const getLists = lists;
            if(getLists && getLists.length > 0){
                getLists.forEach(li=> {
                    var user1 = li.user_1;
                    var user2 = li.user_2;
                    if(user1.id != user2.id){
                        const discussionContainer = document.querySelector('.discussion-container .tab-content #profile');
                        const discussionDiv = document.createElement('div');
                        discussionDiv.classList.add('discussion', 'message-active');
                        discussionDiv.innerHTML +=`
                                <a href="#" class="group_chat_id user1_Id" style="display: contents;" id="${user1.id}" data-user-id-1="${user1.id}" data-user-id-2="${user2.id}">
                                    <div class="photo"
                                        style="background-image:
                                        url(${user1.image_url});">
                                    </div>
                                    <div class="desc-contact">
                                            <p class="name">${user1.name}</p>
                                        <p class="message"></p>
                                    </div>
                                    <i class="fa-solid fa-arrow-right-arrow-left"></i>                                    </a>
                                    <a href="#" class="group_chat_id user2_Id" style="display: contents;"  data-user-id-1="${user1.id}" data-user-id-2="${user2.id}">
                                    <div class="photo"
                                        style="background-image:
                                        url(${user2.image_url});">
                                    </div>
                                    <div class="desc-contact">
                                            <p class="name">${user2.name}</p>
                                        <p class="message"></p>
                                    </div>
                                    </a>
                            ` ;
                            discussionContainer.appendChild(discussionDiv);
                    }
                })
                $('.group_chat_id').click(async function(event){
                    var user1_Id = $(this).data('user-id-1');
                    var user2_Id = $(this).data('user-id-2');
                    event.preventDefault();
                    var url = "{{ route('all.messages', ['user_1' => ':user1Id', 'user_2' => ':user2Id']) }}"
                    .replace(':user1Id', user1_Id)
                    .replace(':user2Id', user2_Id);
                    await $.ajax({
                    type: 'GET',
                    url:url,
                    success: function(data) {
                        if (data.success) {
                            populateMessages(data.messages,data.user);
                        } else if(data.success) {
                            alert("Failed to start the chat. Please try again.");
                        }
                    },
                    error: function(data) {
                        alert(data.error);
                    }
                  });
                })
            }
        }
        function searchList(lists){
            if(lists.length > 0){
                document.querySelector('#search-lists').style.display = 'block';
                const listsElement = document.getElementById('search-lists');
                let user;
                lists.forEach(list =>{
                    if(list.user_1.id != {{Auth::user()->id}} || list.user_2.id != {{Auth::user()->id}}){
                        if (list.user_1.id !== {{ Auth::user()->id }}) {
                             user = list.user_1;
                        } else {
                             user = list.user_2;
                        }
                        listsElement.innerHTML = `
                            <a href='#' class='create_chat_with search-name' id="${user.id}" data-user-id="${user.id}"><li class='create_chat_with'  id="${user.id}" data-user-id="${user.id}"><img class='search-img'src='${user.image_url}'/>${user.name}</li></a>
                        `;
                    }
                })
            }else if(lists.length <= 0){
                document.querySelector('#search-lists').style.display = 'none';
            }
            $(".create_chat_with").click(async function(e) {
                e.preventDefault();
                 userId = $(this).attr('id');
                if (userId) {
                await $.ajax({
                        type: 'GET',
                        url: "{{ route('new-chat', ['id' => ':userId']) }}".replace(':userId', userId),
                        success: function(data) {
                            if (data.success) {
                                $('#newChatModal').modal('hide')
                                initialData = data.user;
                                populateMessages(data.messages,data.user);
                            } else if(data.success) {
                                alert("Failed to start the chat. Please try again.");
                            }
                        },
                        error: function(data) {
                            alert(data.error);
                        }
                    });
                } else {
                    alert("User ID is empty or undefined.");
                }
                });
        }
         function getLists(lists){
            const getLists = lists;
            if(getLists && getLists.length > 0){
                getLists.forEach(li => {
                    let user;
                    if (li.user_1.id !== {{ Auth::user()->id }}) {
                        user = li.user_1;
                    } else {
                        user = li.user_2;
                    }
                    var adminId = {{Auth::user()->role_id}}
                    if(adminId == 1){
                        const discussionContainer = document.querySelector('.discussion-container .tab-content #home');
                        const discussionDiv = document.createElement('div');
                        discussionDiv.innerHTML = '';
                        discussionDiv.classList.add('discussion', 'message-active');
                        discussionDiv.innerHTML = `
                            <a href="#" class="create_chat_with" style="display: contents;" id="${user.id}" data-user-id="${user.id}">
                                <div class="photo" style="background-image: url(${user.image_url});"></div>
                                <div class="desc-contact">
                                    <p class="name">${user.name}</p>
                                    <p class="message"></p>
                                </div>
                                <p class="badge">${user.role.name}</p>
                            </a>
                        `;

                        discussionContainer.appendChild(discussionDiv);
                    }
                    else if(user.id !== {{Auth::user()->id}}){
                        const discussionDiv = document.querySelector('.discussion-container');
                        discussionDiv.innerHTML +=`
                            <div class="discussion message-active">
                            <a href="#" class="create_chat_with" style="display: contents;" id="${user.id}" data-user-id="${user.id}">
                                <div class="photo"
                                    style="background-image:
                                    url(${user.image_url});">
                                </div>
                                <div class="desc-contact">
                                        <p class="name">${user.name}</p>
                                    <p class="message"></p>
                                </div>
                                <i class="fa-sharp fa-solid fa-check-double"></i>
                                </a>
                            </div>
                            ` ;
                        $('.discussion-container').append(discussionDiv); 
                    }
                });
            $(".create_chat_with").click(async function(e) {
                e.preventDefault();
                 userId = $(this).attr('id');
                if (userId) {
                await $.ajax({
                        type: 'GET',
                        url: "{{ route('new-chat', ['id' => ':userId']) }}".replace(':userId', userId),
                        success: function(data) {
                            if (data.success) {
                                $('#newChatModal').modal('hide')
                                initialData = data.user;
                                populateMessages(data.messages,data.user);
                            } else if(data.success) {
                                alert("Failed to start the chat. Please try again.");
                            }
                        },
                        error: function(data) {
                            alert(data.error);
                        }
                    });
                } else {
                    alert("User ID is empty or undefined.");
                }
                });
            }
            else{
                alert('No Chat found Would you like to Start a chat with someone!');
            }
        }
          $(document).ready(function() {
            $(".newChat").click(async function() {
                $(".overlay").css('display','none')
                // $("#loader").show();
                const url = "{{ route('get-users-for-new-chat') }}"
                let users = await $.get(url);
                $('.new_chat_users_div').html('');
                $(users).each(function(i, user) {
                    const baseUrl = "{{ url('storage/') }}";  
                    let html =
                        `<div class="new-chat-user-div create_chat_with" id="${user.id}"style="padding: 6px 0px;"><img class="new-chat-img" src="${baseUrl}/${user.image}" /><a href="#" class="create_chat_with" id="${user.id}">${user.name}</a></div>`;
                    $('.new_chat_users_div').append(html);
                })
            $(".create_chat_with").click(async function(e) {
            e.preventDefault();
            userId = $(this).attr('id');
            if (userId) {
            await  $.ajax({
                    type: 'GET',
                    url: "{{ route('new-chat', ['id' => ':userId']) }}".replace(':userId', userId),
                    success: function(data) {
                        if (data.success) {
                            $('#newChatModal').modal('hide')
                            $(".overlay").css('display','none')
                            populateMessages(data.messages,data.user);
                        } else if(data.success) {
                            alert("Failed to start the chat. Please try again.");
                        }
                    },
                    error: function(data) {
                        alert(data.error);
                    }
                });
            } else {
                alert("User ID is empty or undefined.");
            }
            });
            $('#newChatModal').modal('show');
            $('.close').click(function(e){
                $(".overlay").css('display','none')
                $('#newChatModal').modal('hide')
            });
        })
        }); 
        function populateMessages(chat,user) {
            inputMessage.disabled = false;
            inputMessage.placeholder="Type your message here"
            const messages = chat;
            const userData = user;
            var userImg = userData.image_url
            const messageContainer = document.querySelector(".messages-chat");
            document.querySelector('.header-chat .img-chat').innerHTML = '';
            document.querySelector('.header-chat .img-chat').innerHTML +=`<img class="icon-chat" src="${userData.image_url?userData.image_url:''}" />`;
            document.querySelector('.header-chat .name').innerHTML = userData.name;
            //document.querySelector('.header-chat .badge').innerHTML = userData.role.name;
            if (messages && messages.length > 0) {
                var containerMess = document.querySelector('#container-message');
                containerMess.innerHTML = '';
                messages.forEach((message) => {
                    if(message.from_id == {{Auth::user()->id}} ){
                        var time = new Date(message.created_at).toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit', hour12: true, year:'numeric', month:'2-digit',day:'2-digit' }) ;
                        if(message.file !== null){
                        containerMess.innerHTML +=`
                        <div class="message text-only">
                            <div class="response">
                                <p style="padding:15px;" class="text">${message.message}</p>
                                <div>
                                    ${message.file_url?message.file_type:''}    
                                </div>
                            </div>
                        </div>
                        <p class="time my_time">${time}<i class="fa-sharp fa-solid fa-check-double"></i></p>
                        `
                    }else{
                        containerMess.innerHTML +=`
                        <div class="message text-only">
                            <div class="response">
                                <p style="padding:15px;" class="text">${message.message}</p>
                            </div>
                        </div>
                        <p class="time my_time">${time}<i class="fa-sharp fa-solid fa-check-double"></i></p>
                        `
                    }
                    }else if(message.to_id == {{Auth::user()->id}} ){
                        inputMessage.disable = false;
                        var time = new Date(message.created_at).toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit', hour12: true, year:'numeric', month:'2-digit',day:'2-digit' }) ;
                        if(message.file !== null ){
                        containerMess.innerHTML +=`
                        <div class="message">
                            <div class="online"></div>
                        </div>
                            <div class="photo-with-message" style="background-image: url(${userImg});"></div>
                            <div>
                                ${message.file_url?message.file_type:''}    
                            </div>
                            <p style="padding:15px; width:max-content;margin-left: 82px;" class="text"> ${message.message} </p>
                        
                        <p class="time">${time}</p>
                        `;
                        }else{
                            containerMess.innerHTML +=`
                                <div class="message">
                                    <div class="photo-with-message" style="background-image: url(${userImg});">
                                    <div class="online"></div>
                                    </div>
                                    <p style="padding:15px;" class="text"> ${message.message} </p>
                                </div>
                                <p class="time">${time}</p>
                                `;
                        }
                    }
                    else if(message.to_id !== {{Auth::user()->id}} && message.from_id !== {{Auth::user()->id}}){
                        inputMessage.disabled = true;
                        inputMessage.placeholder = "You can only read messages and cannot send messages.";
                        var time = new Date(message.created_at).toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit', hour12: true, year:'numeric', month:'2-digit',day:'2-digit' }) ;
                        if(message.file !== null ){
                        containerMess.innerHTML +=`
                        <div class="message">
                            <div class="online"></div>
                        </div>
                        <div class="photo-with-message" style="background-image: url(${userImg});">
                            <div>
                                ${message.file_url?message.file_type:''}    
                            </div>
                            <p style="padding:15px;" class="text"> ${message.message} </p>
                        </div>
                        <p class="time">${time}</p>
                        `;
                        }else{
                            containerMess.innerHTML +=`
                                <div class="message">
                                    <div class="photo-with-message" style="background-image: url(${userImg});">
                                    <div class="online"></div>
                                    </div>
                                    <p style="padding:15px;" class="text"> ${message.message} </p>
                                </div>
                                <p class="time">${time}</p>
                                `;
                        }
                    }
                });
            }else{
                var containerMess = document.querySelector('#container-message');
                containerMess.innerHTML = '<p class="no-chat">Nothing to Show...Start New Chat Here!</p>';
            }
        }
    let token = $('meta[name="csrf-token"]').attr('content');
    let form = document.getElementById('form');
    let inputMessage = document.getElementById('input-message');
    let container = document.getElementById('container-message');
    let roomid = document.getElementById('room-id');
    const roomId = roomid.value;
    let touserId =document.getElementById('touserId');
    const toUserId = touserId.value;

    let send = document.getElementById('send-btn');
    let typing = document.getElementById('typing');
    let status = document.getElementById('status');
    let read_message = document.querySelectorAll('.fa-check-double.unreaded');

    let usersOnline = [];
    const channel = Echo.join(`message.${roomId}`);
    function add_status_code()
    {
        let status_code = 0
        usersOnline.forEach(user => {
            if(user.id == toUserId){
                status_code = 1
            }
        });
        return status_code
    }

    function check_message_status(message)
    {
        let status_t = 'unreaded'
        if(message.status == 1){
            status_t = 'readed'
        }
        return status_t
    } 
    function read_all_message()
    {
        usersOnline.forEach(user => {
                if(user.id == toUserId){
                    let readedd = document.querySelectorAll('.fa-check-double.unreaded');
                    readedd.forEach(el=>{
                        el.className = 'fa-sharp fa-solid fa-check-double readed';
                    })
                    $.ajax({
                        method: "POST",
                        url: "/read_all",
                        data: {
                        toId: toUserId,
                        roomId: roomId,
                        _token: token

                        },
                    });
                }
        });
    }
    async function appendMessage(userId){
      await $.ajax({
                type: 'GET',
                url: "{{ route('new-chat', ['id' => ':userId']) }}".replace(':userId', userId),
                success: function(data) {
                    if (data.success) {
                        $('#newChatModal').modal('hide')
                        $(".overlay").css('display','none')
                        populateMessages(data.messages,data.user);
                    } else if(data.success) {
                        alert("Failed to start the chat. Please try again.");
                    }
                },
                error: function(data) {
                    alert(data.error);
                }
            });
        }



        //show in typing 
        inputMessage.addEventListener('input',function(event){
            if(inputMessage.value.length == 0){
                channel.whisper('stop-typing');
            }else{
                channel.whisper('typing',{
                    name: "{{$user->name}}"
                })
            }
        })
            form.addEventListener('submit', function (event) {
            event.preventDefault();
            
            const userInput = inputMessage.value;
            const inputfile = document.querySelector('#file');
            const image = inputfile.files[0];
            let status_code = add_status_code();

            const formData = new FormData();
            formData.append('message', userInput);
            formData.append('roomid', roomId);
            formData.append('touserId', userId);
            formData.append('status', status_code);
            formData.append('file', image);
            formData.append('_token', token);

            $.ajax({
            method: "POST",
            url: "{{route('send')}}",
            data: formData,
            processData: false,
            contentType: false,
            }).done(function (data) {
                if (data.success) {
                    appendMessage(userId);
                    inputMessage.value="";
                    file.value="";
                } else {
                        alert("Error: Something went wrong. Please try again.");
                }
            }).fail(function (xhr, status, error) {
                console.error("request failed with error: " + error);
            });
            channel.whisper('stop-typing');
        })
        $('.clickable').click( function (event) {
            event.preventDefault();
            
            const userInput = inputMessage.value;
            const inputfile = document.querySelector('#file');
            const image = inputfile.files[0];
            let status_code = add_status_code();

            const formData = new FormData();
            formData.append('message', userInput);
            formData.append('roomid', roomId);
            formData.append('touserId', userId);
            formData.append('status', status_code);
            formData.append('file', image);
            formData.append('_token', token);

            $.ajax({
            method: "POST",
            url: "{{route('send')}}",
            data: formData,
            processData: false,
            contentType: false,
        }).done(function (data) {
            if (data.success) {
                appendMessage(userId);
                inputMessage.value="";
                file.value="";
            } else {
                    alert("Error: Something went wrong. Please try again.");
            }
        }).fail(function (xhr, status, error) {
            console.error("request failed with error: " + error);
        });
            channel.whisper('stop-typing');
    })
    </script>
    @endpush