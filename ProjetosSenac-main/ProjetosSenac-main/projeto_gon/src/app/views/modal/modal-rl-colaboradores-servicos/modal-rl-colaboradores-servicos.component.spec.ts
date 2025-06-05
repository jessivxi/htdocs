import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ModalRlColaboradoresServicosComponent } from './modal-rl-colaboradores-servicos.component';

describe('ModalRlColaboradoresServicosComponent', () => {
  let component: ModalRlColaboradoresServicosComponent;
  let fixture: ComponentFixture<ModalRlColaboradoresServicosComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ModalRlColaboradoresServicosComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ModalRlColaboradoresServicosComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
