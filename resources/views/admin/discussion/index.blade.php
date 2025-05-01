@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-4">
            <div class="card border-0 shadow-lg rounded-4 mb-4">
                <div class="card-header bg-primary bg-gradient p-4 border-0">
                    <h5 class="mb-0 text-white">
                        <i class="bi bi-chat-dots me-2"></i>New Message
                    </h5>
                </div>
                <div class="card-body p-4">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('admin.discussion.send') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label text-muted">Select Recipient</label>
                            <select name="receiver_id" class="form-select border-0 bg-light rounded-3 py-3">
                                <option value="">All Users</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->fullname }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-muted">Message</label>
                            <textarea name="message" class="form-control border-0 bg-light rounded-3" 
                                      rows="5" required placeholder="Type your message here..."></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary rounded-pill px-4 w-100">
                            <i class="bi bi-send me-2"></i>Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-header bg-primary bg-gradient p-4 border-0">
                    <h5 class="mb-0 text-white">
                        <i class="bi bi-chat-square-text me-2"></i>Message History
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div id="messages-container" class="p-4" 
                         style="max-height: 600px; overflow-y: auto; scrollbar-width: thin;">
                        <div class="d-flex flex-column gap-3" id="message-list">
                            @foreach($messages as $msg)
                                <div class="message-item {{ $msg->sender_id == auth()->id() ? 'message-sent' : 'message-received' }}">
                                    <div class="message-content {{ $msg->sender_id == auth()->id() ? 'bg-primary text-white' : 'bg-light' }} rounded-4 p-3">
                                        <div class="message-header d-flex justify-content-between align-items-center mb-2">
                                            <span class="fw-semibold">
                                                {{ $msg->sender_id == auth()->id() ? 'You' : $msg->sender->fullname }}
                                            </span>
                                            @if($msg->receiver_id)
                                                <span class="badge {{ $msg->sender_id == auth()->id() ? 'bg-white text-primary' : 'bg-info bg-opacity-10 text-info' }} rounded-pill px-2 py-1" style="font-size: 0.7rem;">
                                                    Private to {{ optional($msg->receiver)->fullname }}
                                                </span>
                                            @else
                                                <span class="badge {{ $msg->sender_id == auth()->id() ? 'bg-white text-primary' : 'bg-success bg-opacity-10 text-success' }} rounded-pill px-2 py-1" style="font-size: 0.7rem;">
                                                    Broadcast
                                                </span>
                                            @endif
                                        </div>
                                        <p class="mb-1">{{ $msg->message }}</p>
                                        <small class="{{ $msg->sender_id == auth()->id() ? 'text-white-50' : 'text-muted' }}">
                                            <i class="bi bi-clock me-1"></i>{{ $msg->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.form-control:focus, .form-select:focus {
    box-shadow: none;
    border-color: #dee2e6;
}
.message-item {
    transition: all 0.3s ease;
}
.message-item:hover {
    transform: translateX(5px);
}
#messages-container::-webkit-scrollbar {
    width: 6px;
}
#messages-container::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}
#messages-container::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 3px;
}
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var messageContainer = document.getElementById("messages-container");
        var messageList = document.getElementById("message-list");

        function scrollToBottom(force = false) {
            if (force || (messageContainer.scrollTop + messageContainer.clientHeight >= messageContainer.scrollHeight - 50)) {
                messageContainer.scrollTop = messageContainer.scrollHeight;
            }
        }

        scrollToBottom(true);

        var observer = new MutationObserver(function () {
            scrollToBottom();
        });

        observer.observe(messageList, { childList: true });

        messageContainer.addEventListener("scroll", function () {
            if (messageContainer.scrollTop + messageContainer.clientHeight < messageContainer.scrollHeight - 50) {
                observer.disconnect(); 
            } else {
                observer.observe(messageList, { childList: true });
            }
        });
    });
</script>
@endsection
