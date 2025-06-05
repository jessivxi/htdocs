import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ColaboreadoresComponent } from './colaboreadores.component';

describe('ColaboreadoresComponent', () => {
  let component: ColaboreadoresComponent;
  let fixture: ComponentFixture<ColaboreadoresComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ColaboreadoresComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ColaboreadoresComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
