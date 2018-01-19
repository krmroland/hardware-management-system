<template>
    <tr>
        <td><slot></slot></td>
        <table-cell
            v-for="(column,index) in visibleColumns"
            :row="row"
            :column="column"
            :key="index"
        ></table-cell>
    </tr>
</template>

<script>
    import TableCell from './tableCell';

    export default {
        props: ['columns', 'row'],

        components: {
            TableCell,
        },

        computed: {
            visibleColumns() {
                return this.columns.filter(column => ! column.hidden);
            },
        },
    };
</script>
