<template>
    <div class="modal fade" id="globalModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" :class="size" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ title }}</h5>
                    <button type="button" class="close" @click="close">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <slot></slot>
                </div>
                <div class="modal-footer">
                    <slot name="footer">
                        <button class="btn btn-secondary" @click="close">Close</button>
                    </slot>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        title: {
            type: String,
            default: 'Modal'
        },
        size: {
            type: String,
            default: ''
        }
    },
    methods: {
        show() {
            $('#globalModal').modal('show');
        },
        close() {
            $('#globalModal').modal('hide');
        }
    }
}
</script>
