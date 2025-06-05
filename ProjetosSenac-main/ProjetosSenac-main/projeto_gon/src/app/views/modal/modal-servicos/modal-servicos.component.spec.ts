import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ModalServicosComponent } from './modal-servicos.component';

describe('ModalServicosComponent', () => {
  let component: ModalServicosComponent;
  let fixture: ComponentFixture<ModalServicosComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ModalServicosComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ModalServicosComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
