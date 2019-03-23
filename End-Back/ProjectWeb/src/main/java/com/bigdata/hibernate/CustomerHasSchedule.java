package com.bigdata.hibernate;

import javax.persistence.*;

@Entity
@Table(name = "customer_has_schedule", schema = "mydb", catalog = "")
@IdClass(CustomerHasSchedulePK.class)
public class CustomerHasSchedule {
    private String customerEmail;
    private int scheduleIdschedule;

    @Id
    @Column(name = "customer_email", nullable = false, length = 50)
    public String getCustomerEmail() {
        return customerEmail;
    }

    public void setCustomerEmail(String customerEmail) {
        this.customerEmail = customerEmail;
    }

    @Id
    @Column(name = "schedule_idschedule", nullable = false)
    public int getScheduleIdschedule() {
        return scheduleIdschedule;
    }

    public void setScheduleIdschedule(int scheduleIdschedule) {
        this.scheduleIdschedule = scheduleIdschedule;
    }

    @Override
    public boolean equals(Object o) {
        if (this == o) return true;
        if (o == null || getClass() != o.getClass()) return false;

        CustomerHasSchedule that = (CustomerHasSchedule) o;

        if (scheduleIdschedule != that.scheduleIdschedule) return false;
        if (customerEmail != null ? !customerEmail.equals(that.customerEmail) : that.customerEmail != null)
            return false;

        return true;
    }

    @Override
    public int hashCode() {
        int result = customerEmail != null ? customerEmail.hashCode() : 0;
        result = 31 * result + scheduleIdschedule;
        return result;
    }
}
