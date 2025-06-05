import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ModalRlColabServFormComponent } from './modal-rl-colab-serv-form.component';

describe('ModalRlColabServFormComponent', () => {
  let component: ModalRlColabServFormComponent;
  let fixture: ComponentFixture<ModalRlColabServFormComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ModalRlColabServFormComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ModalRlColabServFormComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
