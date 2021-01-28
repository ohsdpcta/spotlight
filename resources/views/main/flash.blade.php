@if(session('flash_message'))
    <transition name="fade" id="flash-message">
        <div v-if="show" class="alert alert-primary text-center py-3 my-0">
            {{ session('flash_message') }}
        </div>
    </transition>
@elseif(session('flash_message_error'))
    <transition name="fade" id="flash-message">
        <div v-if="show" class="alert alert-danger text-center py-3 my-0">
            {{ session('flash_message_error') }}
        </div>
    </transition>
@endif
