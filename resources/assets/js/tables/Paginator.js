import { slice, get, range } from "lodash";

class Paginator {
	/**
	 * create an instance of the paginator class
	 *
	 * @param      {object}  items        
	 * @param      {number}   perPage     the number of items per page
	 * @param      {number}   currentPage  The current page
	 */
	constructor(items = [], perPage = 10, currentPage = 1) {
		this._items = items;
		this._perPage = Number(perPage);
		this._currentPage = Number(currentPage);
	}
	/**
	 * Sets the items.
	 *
	 * @param      {object}  items   
	 */
	set items(items) {
		this._currentPage = 1;
		this._items = items;
	}
	/**
	 * sets the number of items per page
	 *
	 * @param      {number}  perpage  
	 */
	set perPage(perPage) {
		this._currentPage = 1;
		this._perPage = Number(perPage);
	}
	/**
	 * sets the current page
	 *
	 * @param      {number}  currentPage  The current page
	 */
	set currentPage(currentPage) {
		if (currentPage > 0) {
			this._currentPage = Number(currentPage);
		}
	}
	get currentPage() {
		return this._currentPage;
	}
	get perPage() {
		return this._perPage;
	}

	get items() {
		return this._items;
	}

	get collection() {
		return slice(this.items, this.start, this.end);
	}

	get start() {
		return (this.currentPage - 1) * this._perPage;
	}
	get end() {
		let end = this.start + this.perPage;

		if (end < this.items.length) {
			return end;
		}
		return this.totalItems;
	}
	get onFirstPage() {
		return this.currentPage == 1;
	}

	get onLastPage() {
		return this.currentPage == this.lastPage;
	}

	get lastPage() {
		return Math.ceil(this.totalItems / this.perPage);
	}

	get totalItems() {
		return this.items.length;
	}
	get links() {
		if (this.lastPage < 12) {
			return range(1, this.lastPage + 1);
		}
		if (this.currentPage < 6) {
			return range(1, 10).concat(["..."]).concat(this.endItems);
		}
		if (this.currentPage > this.lastPage - 6) {
			return [1, 2, "..."].concat(
				range(this.lastPage - 8, this.lastPage + 1)
			);
		}
		return [1, 2, "..."]
			.concat(range(this.currentPage - 3, this.currentPage + 3))
			.concat(["..."])
			.concat(this.endItems);
	}
	get endItems() {
		return Array(this.lastPage - 1, this.lastPage);
	}

	get shouldPaginate() {
		return this.totalItems > this.perPage;
	}

	get startingIndex() {
		return (this.currentPage - 1) * this.perPage + 1;
	}

	get uptoItems() {
		if (this.onLastPage) {
			return this.totalItems;
		}
		return this.currentPage * this.perPage;
	}

	get isEmpty() {
		return !this.collection.length;
	}
}

export default Paginator;
