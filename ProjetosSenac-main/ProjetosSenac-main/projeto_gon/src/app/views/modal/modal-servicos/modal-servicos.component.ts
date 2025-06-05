import { Component, Input } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { NbDialogRef } from '@nebular/theme';
import { ApiService } from 'src/app/services/ApiService';

@Component({
  selector: 'app-modal-servicos',
  templateUrl: './modal-servicos.component.html',
  styleUrls: ['./modal-servicos.component.scss'],
})
export class ModalServicosComponent {
  constructor(
    private _formBuilder: FormBuilder,
    private _dialogRef: NbDialogRef<ModalServicosComponent>,
    private _provider: ApiService
  ) {}

  @Input() id: number = 0;

  metodo: string = 'POST';

  private api: string = 'apiServicos.php'; // CAMINHO DA API

  public loading: boolean = false;

  // CONSTROI OS PARAMETROS DO FORMULÁRIO - INICIO
  public formulario: FormGroup = this._formBuilder.group({
    id_servico: [this.id,[Validators.required]],
    status: ['1', [Validators.required]],
    nome: [null, [Validators.required]],
    tempo: [null, [Validators.required]],
    valor: [null, [Validators.required]],
    descricao: [null, [Validators.required]],
  });
  // CONSTROI OS PARAMETROS DO FORMULÁRIO - FIM

  ngOnInit(): void {
    // CARREGA CADASTRO
    if (this.id > 0) {
      this.getDados(this.id);
    }
  }

  getDados(id: number) {
    this.loading = true;

    let url = this.api + '?id_servico=' + id;

    return this._provider.getAPI(url).subscribe(
      (data: any) => {
        if (data['status'] == 'success') {
          this.formulario.patchValue({
            id_servico: data['result'].id_servico,
            nome: data['result'].nome,
            tempo: data['result'].tempo,
            valor: data['result'].valor,
            descricao: data['result'].descricao,
            status: data['result'].status.toString()
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

  //ENVIA DADOS VIA API PARA BANCO - INICIO
  onSubmit() {
    this.loading = true;

    let dados = {
      form: this.formulario.value,
    };
  
    if (this.metodo == 'POST') {
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
          this.loading = false;
          this._dialogRef.close('update');
        }
      );
    } else {
      this._provider.putAPI(dados, this.api).subscribe(
        (data: any) => {
          if (data['status'] == 'success') {
            this._provider.showToast('OBA!', data['result'], 'success');
          } else {
            this._provider.showToast('OPS!', data['result'], 'danger');
          }
        },
        (error: any) => {
          this.loading = false;
        },
        () => {
          this.loading = false;
          this._dialogRef.close('update');
        }
      );
    }
  }
  //ENVIA DADOS VIA API PARA BANCO - FIM

  // FECHA MODAL SERVIÇOS - INICIO
  close() {
    this._dialogRef.close();
  }
  // FECHA MODAL SERVIÇOS - FIM
}
