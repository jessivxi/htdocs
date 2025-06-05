import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ModalLocaisComponent } from './modal-locais.component';

describe('ModalLocaisComponent', () => {
  let component: ModalLocaisComponent;
  let fixture: ComponentFixture<ModalLocaisComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ModalLocaisComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ModalLocaisComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
