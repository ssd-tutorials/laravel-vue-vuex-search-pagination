<script>
import { mapState, mapGetters } from 'vuex';
export default {
    name: 'SearchResults',
    props: {
        group: {
            type: String,
            required: true
        }
    },
    computed: {
        ...mapState('search', ['params', 'records']),
        ...mapGetters('search', ['total']),
        compParams() {
            return this.params[this.group];
        },
        compTotal() {
            return this.total(this.group);
        },
        compRecords() {
            return this.records[this.group] || [];
        }
    },
    render() {
        return this.$scopedSlots.default({
            params: this.compParams,
            total: this.compTotal,
            records: this.compRecords
        });
    }
};
</script>
