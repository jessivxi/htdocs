import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ReactiveFormsModule } from '@angular/forms';
import { NbAutocompleteModule, NbButtonGroupModule, NbButtonModule, NbCardModule, NbFormFieldModule, NbIconModule, NbInputModule, NbListModule, NbSelectModule, NbSpinnerModule, NbTabsetModule, NbToggleModule } from '@nebular/theme';

import { NgxMaskDirective, NgxMaskPipe, provideNgxMask } from 'ngx-mask';
import { Angular2SmartTableModule } from 'angular2-smart-table';
import { CKEditorModule } from '@ckeditor/ckeditor5-angular';
import { ModalClientesComponent } from './modal-clientes/modal-clientes.component';
import { ModalColaboradoresComponent } from './modal-colaboradores/modal-colaboradores.component';
import { ModalServicosComponent } from './modal-servicos/modal-servicos.component';
import { ModalLocaisComponent } from './modal-locais/modal-locais.component';
import { ModalRlColaboradoresServicosComponent } from './modal-rl-colaboradores-servicos/modal-rl-colaboradores-servicos.component';
import { ModalRlColabServFormComponent } from './modal-rl-colab-serv-form/modal-rl-colab-serv-form.component';
import { ModalLocalColaboradoresServicosComponent } from './modal-local-colaboradores-servicos/modal-local-colaboradores-servicos.component';



@NgModule({
  declarations: [
    ModalClientesComponent,
    ModalColaboradoresComponent,
    ModalServicosComponent,
    ModalLocaisComponent,
    ModalRlColaboradoresServicosComponent,
    ModalRlColabServFormComponent,
    ModalLocalColaboradoresServicosComponent
  ],
  imports: [
    Angular2SmartTableModule,
    CKEditorModule,
    CommonModule,
    NbAutocompleteModule,
    NbButtonModule,
    NbButtonGroupModule,
    NbCardModule,
    NbFormFieldModule,
    NbIconModule,
    NbInputModule,
    NbListModule,
    NbSelectModule,
    NbSpinnerModule,
    NbTabsetModule,
    NbToggleModule,
    NgxMaskDirective, NgxMaskPipe,
    ReactiveFormsModule,
  ],
  exports: [
    ModalClientesComponent,
  ],
  providers: [
    provideNgxMask()
  ]
})
export class ModalModule { }
