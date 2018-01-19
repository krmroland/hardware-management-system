import pick from 'lodash/pick';

export default class Column {
    constructor(columnComponent) {
        const properties = pick(columnComponent, [
            'dataKey', 'label', 'dataType', 'hidden', 'formatter','filterable','cellClass'
        ]);

        for (const property in properties) {
            this[property] = columnComponent[property];
        }

        this.template = columnComponent.$scopedSlots.default;
    }


    isFilterable() {
        return this.filterable;
    }
}
