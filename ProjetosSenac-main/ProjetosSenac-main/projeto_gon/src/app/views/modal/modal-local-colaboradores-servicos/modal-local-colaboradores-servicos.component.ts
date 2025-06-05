import { Component, Input, OnInit } from '@angular/core';
import { NbDialogRef, NbDialogService} from '@nebular/theme';
import { ApiService } from 'src/app/services/ApiService';


@Component({
  selector: 'app-modal-local-colaboradores-servicos',
  templateUrl: './modal-local-colaboradores-servicos.component.html',
  styleUrls: ['./modal-local-colaboradores-servicos.component.scss'],
})
export class ModalLocalColaboradoresServicosComponent {
  @Input() id_local: number | undefined;

  users: { name: string, title: string }[] = [
    { name: 'Carla Espinosa', title: 'Nurse' },
    { name: 'Bob Kelso', title: 'Doctor of Medicine' },
    { name: 'Janitor', title: 'Janitor' },
    { name: 'Perry Cox', title: 'Doctor of Medicine' },
    { name: 'Ben Sullivan', title: 'Carpenter and photographer' },
  ];

  constructor(
    private _provider: ApiService,
    private _dialogService: NbDialogService,
    private _dialogRef: NbDialogRef<ModalLocalColaboradoresServicosComponent>
  ) {}

  close() {
    this._dialogRef.close();
  }
}
