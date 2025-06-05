import { Component, Input, OnInit } from '@angular/core';
import { NbDialogService } from '@nebular/theme';

import { ApiService } from 'src/app/services/ApiService';

import { IColumnType, LocalDataSource, Settings } from 'angular2-smart-table';

import { ModalLocaisComponent } from '../../modal/modal-locais/modal-locais.component';

import { ModalLocalColaboradoresServicosComponent } from 'src/app/views/modal/modal-local-colaboradores-servicos/modal-local-colaboradores-servicos.component';

type NewType = number;
@Component({
  template: `
    <div class="text-center d-flex justify-content-around">
      <a
        class="d-flex justify-content-center align-items-center"
        title="Lista de Serviços"
        status="info"
        (click)="onColaboradoresServicos()"
        ><i class="bi bi-person-lines-fill fs-4"></i></a>
    </div>
  `,
  styleUrls: ['./locais.component.scss'],
})
export class BtnServicosColaboradoresComponent implements OnInit {

  @Input() rowData: any;

  constructor(private _dialogService: NbDialogService) {}

  ngOnInit() {}

  onColaboradoresServicos() {
    this._dialogService.open(ModalLocalColaboradoresServicosComponent, {
      context: {
        id_local: this.rowData.id_local,
      },
      closeOnEsc: true,
      hasBackdrop: true,
      closeOnBackdropClick: true,
      hasScroll: true,
    });
  }
}

@Component({
  selector: 'app-locais',
  templateUrl: './locais.component.html',
  styleUrls: ['./locais.component.scss'],
})
export class LocaisComponent {
  public source: LocalDataSource = new LocalDataSource();
  public loading: boolean = true;

  public settings: Settings = {
    mode: 'external',
    noDataMessage: 'Nenhum registro foi encontrado.',
    pager: {
      perPage: 5,
      perPageSelect: [5, 10, 20, 40, 80, 160],
      perPageSelectLabel: 'Total: ',
    },
    add: {
      addButtonContent: '<i class="bi bi-plus-square fs-5"></i>',
    },
    actions: {
      columnTitle: '',
      position: 'right',
      edit: false,
      delete: false,
      custom: [
        {
          name: 'edit',
          title:
            '<div class="text-center"><i class="bi bi-pencil-square"></i></div>',
        },
      ],
    },
    columns: {
      nome: {
        title: 'NOME',
        width: '80%',
        sortDirection: 'asc',
      },
      colaboradores: {
        type: IColumnType.Custom,
        width: '10%',
        renderComponent: BtnServicosColaboradoresComponent,
        isFilterable: false,
        isSortable: false,
      },
      status: {
        title: 'STATUS',
        width: '10%',
        sortDirection: 'desc',
        type: IColumnType.Html,
      },
    },
  };

  constructor(
    private _provider: ApiService,
    private _dialogService: NbDialogService
  ) {
    // CARREGAR DADOS NA TABELA
    this.getDados();
  }

  getDados() {
    this.loading = true;
    this.source = new LocalDataSource();

    let url = 'apiLocalAtividade.php';

    return this._provider.getAPI(url).subscribe(
      (data) => {
        // CARREGAR DADOS NA TABELA
        if (data['status'] === 'success') {
          this.status(data['result']);
          this.source.load(data['result']);
        } else {
          this.loading = false;
        }
      },
      (error: any) => {
        this.loading = false;
      },
      () => {
        this.loading = false;
      }
    );
  }

  status(result: any[]) {
    for (let i = 0; i < result.length; i++) {
      if (result[i].status == 1) {
        result[i].status =
          "<div class='text-center'><a class='d-flex justify-content-center align-items-center text-success'><i class='bi bi-check-circle fs-3'></i></a></div>";
      } else {
        result[i].status =
          "<div class='text-center'><a class='d-flex justify-content-center align-items-center text-danger'><i class='bi bi-x-circle fs-3'></i></a></div>";
      }
    }
  }

  ngOnInit(): void {}

  onOptions(event: any) {
    if (event.action == 'edit') {
      // OPÇÃO PARA EDITAR
      this.showDialog(event.data.id_local, 'PUT');
    }
  }

  showDialog(id_local: NewType, metodo: string) {
    this._dialogService
      .open(ModalLocaisComponent, {
        context: {
          id: id_local,
          metodo: metodo,
        },
        closeOnEsc: true,
        hasBackdrop: true,
        closeOnBackdropClick: false,
        hasScroll: true,
      })
      .onClose.subscribe((update) => update && this.getDados());
  }
}
