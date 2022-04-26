import { DataSource } from '@angular/cdk/collections';
import { MatPaginator } from '@angular/material/paginator';
import { MatSort } from '@angular/material/sort';
import { map } from 'rxjs/operators';
import { Observable, of as observableOf, merge } from 'rxjs';

// TODO: Replace this with your own data model type
export interface TableItem {
  tipo: String;
  usuario_abertura: String;
  usuario_fechamento: String;
  titulo: String;
  descricao: String;
  inicio: string;
  previsao: string;
  fim: string;
  task: String;
  incidente: String;
}

// TODO: replace this with real data from your application
const EXAMPLE_DATA: TableItem[] = [
  {   tipo: "Rompimento BKB",
      usuario_abertura: "ewerton.marschalk@redeunifique.com.br",
      usuario_fechamento: "ewerton.marschalk@redeunifique.com.br",
      titulo: "Rompimento CTA_DEB<>SPA",
      descricao: "Rompimento de fibra entre curitiba e são paulo, rota MHNET",
      inicio: new Date("2021-01-01T12:00:00-04:00").toLocaleString(),
      previsao: new Date("2021-01-01T18:00:00-04:00").toLocaleString(),
      fim: new Date("2021-01-01T18:00:00-04:00").toLocaleString(),
      task: "https://tarefas.redeunifique.com.br/workgroups/group/77/tasks/task/view/313707/",
      incidente: "http://tio.redeunifique.com.br/documentos/hd_unifique/hd_suporte_lista.php?iCodIncidente=2022042512093148",

  },
];

/**
 * Data source for the Table view. This class should
 * encapsulate all logic for fetching and manipulating the displayed data
 * (including sorting, pagination, and filtering).
 */
export class TableDataSource extends DataSource<TableItem> {
  data: TableItem[] = EXAMPLE_DATA;
  paginator: MatPaginator | undefined;
  sort: MatSort | undefined;

  constructor() {
    super();
  }

  /**
   * Connect this data source to the table. The table will only update when
   * the returned stream emits new items.
   * @returns A stream of the items to be rendered.
   */
  connect(): Observable<TableItem[]> {
    if (this.paginator && this.sort) {
      // Combine everything that affects the rendered data into one update
      // stream for the data-table to consume.
      return merge(observableOf(this.data), this.paginator.page, this.sort.sortChange)
        .pipe(map(() => {
          return this.getPagedData(this.getSortedData([...this.data ]));
        }));
    } else {
      throw Error('Please set the paginator and sort on the data source before connecting.');
    }
  }

  /**
   *  Called when the table is being destroyed. Use this function, to clean up
   * any open connections or free any held resources that were set up during connect.
   */
  disconnect(): void {}

  /**
   * Paginate the data (client-side). If you're using server-side pagination,
   * this would be replaced by requesting the appropriate data from the server.
   */
  private getPagedData(data: TableItem[]): TableItem[] {
    if (this.paginator) {
      const startIndex = this.paginator.pageIndex * this.paginator.pageSize;
      return data.splice(startIndex, this.paginator.pageSize);
    } else {
      return data;
    }
  }

  /**
   * Sort the data (client-side). If you're using server-side sorting,
   * this would be replaced by requesting the appropriate data from the server.
   */
  private getSortedData(data: TableItem[]): TableItem[] {
    if (!this.sort || !this.sort.active || this.sort.direction === '') {
      return data;
    }

    return data.sort((a, b) => {
      const isAsc = this.sort?.direction === 'asc';
      switch (this.sort?.active) {
        case 'inicio': return compare(a.inicio, b.inicio, isAsc);
        case 'previsao': return compare(+a.previsao, +b.previsao, isAsc);
        default: return 0;
      }
    });
  }
}

/** Simple sort comparator for example ID/Name columns (for client-side sorting). */
function compare(a: string | number | Date, b: string | number | Date, isAsc: boolean): number {
  return (a < b ? -1 : 1) * (isAsc ? 1 : -1);
}
