<transition name="fade" id="flash-message">
    @if(session('flash_message'))
        <div v-if="flash_show" class="alert alert-primary text-center py-3 my-0">
            {{ session('flash_message') }}
        </div>
    @elseif(session('flash_message_error'))
        <div v-if="flash_show" class="alert alert-danger text-center py-3 my-0">
            {{ session('flash_message_error') }}
        </div>
    @endif
</transition>

<script>
    const flashmsg = new Vue({
        el: '#flash-message',
        data: {
            flash_show: false,
        },
        created: function() {
            setTimeout(() => {
                this.flash_show = !this.flash_show;
            }, 100);
            setTimeout(() => {
                this.flash_show = !this.flash_show;
            }, 3000);
        }
    });
</script>