package com.bigdata.hibernate;

import javax.persistence.Basic;
import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.Id;
import java.sql.Date;

@Entity
public class Schedule {
    private int idschedule;
    private byte status;
    private String name;
    private String description;
    private Date startTime;
    private Date endTime;

    @Id
    @Column(name = "idschedule", nullable = false)
    public int getIdschedule() {
        return idschedule;
    }

    public void setIdschedule(int idschedule) {
        this.idschedule = idschedule;
    }

    @Basic
    @Column(name = "status", nullable = false)
    public byte getStatus() {
        return status;
    }

    public void setStatus(byte status) {
        this.status = status;
    }

    @Basic
    @Column(name = "name", nullable = false, length = 45)
    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    @Basic
    @Column(name = "description", nullable = true, length = 300)
    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    @Basic
    @Column(name = "start_time", nullable = false)
    public Date getStartTime() {
        return startTime;
    }

    public void setStartTime(Date startTime) {
        this.startTime = startTime;
    }

    @Basic
    @Column(name = "end_time", nullable = false)
    public Date getEndTime() {
        return endTime;
    }

    public void setEndTime(Date endTime) {
        this.endTime = endTime;
    }

    @Override
    public boolean equals(Object o) {
        if (this == o) return true;
        if (o == null || getClass() != o.getClass()) return false;

        Schedule schedule = (Schedule) o;

        if (idschedule != schedule.idschedule) return false;
        if (status != schedule.status) return false;
        if (name != null ? !name.equals(schedule.name) : schedule.name != null) return false;
        if (description != null ? !description.equals(schedule.description) : schedule.description != null)
            return false;
        if (startTime != null ? !startTime.equals(schedule.startTime) : schedule.startTime != null) return false;
        if (endTime != null ? !endTime.equals(schedule.endTime) : schedule.endTime != null) return false;

        return true;
    }

    @Override
    public int hashCode() {
        int result = idschedule;
        result = 31 * result + (int) status;
        result = 31 * result + (name != null ? name.hashCode() : 0);
        result = 31 * result + (description != null ? description.hashCode() : 0);
        result = 31 * result + (startTime != null ? startTime.hashCode() : 0);
        result = 31 * result + (endTime != null ? endTime.hashCode() : 0);
        return result;
    }
}
