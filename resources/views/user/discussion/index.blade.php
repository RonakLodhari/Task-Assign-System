@extends('layouts.user')

@section('content')
<div class="chat-wrapper">
    <div class="chat-container">
        <div class="chat-header">
            <div class="header-content">
                <i class="bi bi-chat-dots-fill"></i>
                <div class="header-info">
                    <h1>Discussion Room</h1>
                    <span class="online-status">
                        <i class="bi bi-circle-fill"></i> Online
                    </span>
                </div>
            </div>
        </div>

        <div class="chat-box" id="messages-container">
            @foreach($messages as $msg)
                @if(Auth::user()->role == 'admin' || $msg->sender->id == Auth::id() || $msg->receiver_id == Auth::id())
                    <!-- Update the message wrapper section -->
                    <div class="message-wrapper {{ $msg->sender->id == Auth::id() ? 'sent' : 'received' }}">
                        <div class="chat-message">
                            <div class="message-header">
                                <span class="sender-name">
                                    <i class="bi {{ $msg->sender->role == 'admin' ? 'bi-shield-check' : 'bi-person' }}"></i>
                                    {{ $msg->sender->role == 'admin' ? 'Admin' : $msg->sender->fullname }}
                                </span>
                            </div>
                            <div class="message-content">{{ $msg->message }}</div>
                            <div class="message-footer">
                                <span class="timestamp">
                                    <i class="bi bi-clock"></i> 
                                    {{ $msg->created_at->format('H:i') }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <form action="{{ route('user.discussion.send') }}" method="POST" class="chat-input">
            @csrf
            <div class="input-wrapper">
                <textarea name="message" required placeholder="Type your message here......"></textarea>
                <button type="submit">
                    <i class="bi bi-send-fill"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<style>
.chat-wrapper {
    min-height: 100vh;
    padding: 0;
    background: #f0f2f5;
    display: flex;
    justify-content: center;
    align-items: center;
}

.chat-container {
    width: 100%;
    max-width: 600px;
    height: 90vh;
    background: #fff;
    border-radius: 20px;
    display: flex;
    flex-direction: column;
    box-shadow: 0 4px 24px rgba(0, 0, 0, 0.2);
}

.chat-header {
    background: #075e54;
    color: white;
    padding: 20px;
    border-radius: 20px 20px 0 0;
}

.header-content {
    display: flex;
    align-items: center;
    gap: 15px;
}

.header-content i {
    font-size: 24px;
}

.header-info h1 {
    font-size: 18px;
    font-weight: 600;
    margin: 0;
}

.online-status {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 14px;
    opacity: 0.9;
}

.online-status i {
    color: #22c55e;
    font-size: 10px;
}

/* WhatsApp-like Chat Background */
.chat-box {
    flex: 1;
    overflow-y: auto;
    padding: 20px;
    background: #e5ddd5;
    border-radius: 0 0 20px 20px;
    display: flex;
    flex-direction: column;
    gap: 15px;
}

/* Message Bubbles */
.message-wrapper {
    display: flex;
    margin-bottom: 10px;
    align-items: flex-end;
}

.message-wrapper.sent {
    justify-content: flex-end;
}

.message-wrapper.received {
    justify-content: flex-start;
}

.chat-message {
    max-width: 75%;
    padding: 12px 18px;
    border-radius: 18px;
    position: relative;
    background-color: #fff;
    color: #333;
    font-size: 14px;
    line-height: 1.6;
    word-break: break-word;
}

.sent .chat-message {
    background: #075e54;
    color: #fff;
    border-radius: 18px 18px 0 18px;
}

.sent .chat-message::after {
    content: "";
    position: absolute;
    right: -8px;
    bottom: 0;
    width: 12px;
    height: 12px;
    background: #075e54;
    clip-path: polygon(0 0, 100% 100%, 0 100%);
}

.received .chat-message {
    background: #ffffff;
    color: #333;
    border-radius: 18px 18px 18px 0;
}

.received .chat-message::after {
    content: "";
    position: absolute;
    left: -8px;
    bottom: 0;
    width: 12px;
    height: 12px;
    background: #fff;
    clip-path: polygon(100% 0, 100% 100%, 0 100%);
}

/* Sender Avatar (Optional) */
.message-wrapper .avatar {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: #e0e7ef;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    color: #6366f1;
    margin-right: 10px;
}

/* Message Header/Footer */
.message-header {
    margin-bottom: 4px;
}

.sender-name {
    font-size: 12px;
    color: #64748b;
    display: flex;
    align-items: center;
    gap: 4px;
}

.sender-name i {
    font-size: 14px;
    color: #3b82f6;
}

.message-footer {
    margin-top: 6px;
    display: flex;
    justify-content: flex-end;
}

.timestamp {
    font-size: 10px;
    color: #e0e7ef;
    display: flex;
    align-items: center;
    gap: 4px;
}

/* Chat Input Bar */
.chat-input {
    padding: 18px 24px;
    background: #f8fafc;
    border-top: 1px solid #e2e8f0;
    position: relative;
}

.input-wrapper {
    display: flex;
    gap: 12px;
    align-items: flex-end;
    background: #fff;
    border-radius: 24px;
    box-shadow: 0 2px 8px rgba(59,130,246,0.04);
    padding: 6px 12px 6px 18px;
}

textarea {
    flex: 1;
    border: none;
    border-radius: 18px;
    padding: 12px 0;
    resize: none;
    height: 44px;
    font-size: 14px;
    background: transparent;
    color: #333;
    box-shadow: none;
}

textarea:focus {
    outline: none;
    background: transparent;
}

button {
    background: #075e54;
    color: white;
    border: none;
    width: 44px;
    height: 44px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background 0.2s, transform 0.2s;
    box-shadow: 0 2px 8px rgba(34,211,238,0.10);
    margin-left: 4px;
}

button:hover {
    background: #128c7e;
    transform: scale(1.08);
}

button i {
    font-size: 20px;
}

/* Responsive */
@media (max-width: 768px) {
    .chat-wrapper {
        padding: 0;
    }

    .chat-container {
        height: 100vh;
        border-radius: 0;
    }

    .chat-message {
        max-width: 90%;
    }

    .chat-box {
        padding: 16px 0 16px 0;
    }

    .message-wrapper {
        padding: 0 8px;
    }

    .chat-input {
        padding: 12px 8px;
    }
}
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const messageContainer = document.getElementById("messages-container");
        const textarea = document.querySelector('textarea');

        function scrollToBottom() {
            messageContainer.scrollTop = messageContainer.scrollHeight;
        }

        scrollToBottom();

        // Auto-resize textarea
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });
    });
</script>
@endsection
