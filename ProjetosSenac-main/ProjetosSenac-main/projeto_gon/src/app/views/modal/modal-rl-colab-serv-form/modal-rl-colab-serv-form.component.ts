import { Component, Input } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { NbDialogRef, NbDialogService } from '@nebular/theme';
import { LocalDataSource } from 'angular2-smart-table';
import { ApiService } from 'src/app/services/ApiService';
import { ModalServicosComponent } from '../modal-servicos/modal-servicos.component';

@Component({
  selector: 'app-modal-rl-colab-serv-form',
  templateUrl: './modal-rl-colab-serv-form.component.html',
  styleUrls: ['./modal-rl-colab-serv-form.component.scss'],
})
export class ModalRlColabServFormComponent {
  constructor(
    private _provider: ApiService,
    private _dialogService: NbDialogService,
    private _dialogRef: NbDialogRef<ModalServicosComponent>,
    private _formBuilder: FormBuilder
  ) {}

  @Input() id_colaborador: number | undefined;
  @Input() id: number = 0;
  @Input() metodo: string = 'POST';

  private api: string = 'apiRelacaoColaboradorServico.php';

  public formulario: FormGroup = this._formBuilder.group({
    servico: [null, [Validators.required]],
  });

  public source: LocalDataSource = new LocalDataSource();
  public loading: boolean = true;
  public comboServicos: any[] = [];

  selectedItem: any;

  ngOnInit(): void {
    // CARREGAR INFORMAÇÕES
    this.getDados(this.id_colaborador);
  }

  //ENVIA DADOS VIA API PARA BANCO - INICIO
  onSubmit() {
    this.loading = true;

    let dados = this.formulario.value;

    if (this.metodo == 'POST') {
      dados.servico.forEach((element: any) => {
        let dado = {
          form: {
            id_servico: element,
            id_colaborador: this.id_colaborador,
            status: 1,
          },
        };
        this._provider.postAPI(dado, this.api).subscribe(
          (data: any) => {
            if (data['status'] == 'success') {
              this._provider.showToast('OBA!', data['error'], 'success');
            } else {
              this._provider.showToast('OPS!', data['error'], 'danger');
            }
          },
          (error: any) => {
            this.loading = false;
          }
        );
      }
      );
      this.close()
    } else {
      dados = {
        form: this.formulario.value,
      };
      this._provider.postAPI(dados, this.api).subscribe(
        (data: any) => {
          if (data['status'] == 'success') {
            this._provider.showToast('OBA!', data['error'], 'success');
          } else {
            this._provider.showToast('OPS!', data['error'], 'danger');
          }
        },
        (error: any) => {
          this.loading = false;
        },
        () => {
          this.close()
        }
      );
    }
  }
  //ENVIA DADOS VIA API PARA BANCO - FIM

  getDados(id_colaborador: any) {
    this.loading = true;

    let url = this.api + '?id_colaborador=' + id_colaborador + '&filtro=1';

    return this._provider.getAPI(url).subscribe(
      (data: any) => {
        if (data['status'] == 'success') {
          data['result'].forEach((element: any) => {
            this.comboServicos.push(element);
          });
        }
      },
      (erro: any) => {
        this.loading = false;
      },
      () => {
        this.loading = false;
      }
    );
  }

  close() {
    this._dialogRef.close();
  }
}
