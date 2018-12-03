package com.ms2s.cyc.client.paginator;

import java.util.ArrayList;
import java.util.List;

public class Paginator<T> {

	protected List<T> ids;
	protected int page;
	protected int numItems;
	private List<T> el;

	public Paginator(List<T> ids, int page, int numItems) {
		super();
		this.ids = ids;
		this.page = page;
		this.numItems = numItems;
		this.el = new ArrayList<T>(this.numItems);
	}

	public Paginator() {
		super();
	}

	public List<T> getIds() {
		return ids;
	}

	public void setIds(List<T> ids) {
		this.ids = ids;
	}

	public int getPage() {
		if(page > this.getLast()) {
			page = this.getLast();
		}
		return page;
	}

	public void setPage(int page) {
		this.page = page;
	}

	public int getNumItems() {
		return numItems;
	}

	public void setNumItems(int numItems) {
		this.numItems = numItems;
	}

	/*------------------------------------------------*/
	public int getPreviousPage() {
		return this.getPage() - 1;
	}

	public int getNextPage() {
		return this.getPage() + 1;
	}

	public int getFirst() {
		return 1;
	}

	public int getLast() {
		return this.getNumPages();
	}

	public int getCountId() {
		return this.getIds().size();
	}

	public int getNumPages() {
		int i = this.getCountId() / this.getNumItems();
		int o = this.getCountId() % this.getNumItems();
		if (o > 0) {
			i++;
		}
		return i;
	}

	public int getNumItemsForPaginate() {
		int res = this.getNumItems();
		int count = this.getCountId();
		if (this.getNumItems() != 0) {
			if (count % this.getNumItems() != 0) {
				if (this.getPage() == this.getLast()) {
					res = count % this.getNumItems();
				}
			}
		}
		return res;
	}

	public List<T> getElements() {
		// Calculamos la posicion inicial de la pagina
		int initial = (this.getPage() * this.getNumItems()) - this.getNumItems();
		// Recorremos el arraylist el numero de resultados que queremos
		for (int i = 0; i < this.getNumItemsForPaginate(); i++) {
			// Guardamos en un Array los X valores
			this.el.add(i, this.getIds().get(initial + i));
		}
		return el;
	}

	public int[] rangePages(int range) { // HAY QUE PROBARLO
		int[] r = new int[range + 2];

		r[0] = this.getFirst();
		r[(range + 2) - 1] = this.getLast();

		int sup = this.getPage() - (range / 2);

		for (int i = 1; i < range + 1; i++) {
			r[i] = sup;
			sup++;
		}
		return r;
	}
}
