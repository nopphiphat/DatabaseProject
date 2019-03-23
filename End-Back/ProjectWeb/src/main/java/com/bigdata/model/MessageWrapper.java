package com.bigdata.model;

import java.util.Calendar;
import java.util.Date;
import java.util.List;

public class MessageWrapper<T> {

    private List<T> objects;
    private Date date = Calendar.getInstance().getTime();
    private int status =1;
    private String information="";


    public List<T> getObjects() {
        return objects;
    }

    public void setObjects(List<T> objects) {
        this.objects = objects;
    }

    public Date getDate() {
        return date;
    }

    public void setDate(Date date) {
        this.date = date;
    }

    public int getStatus() {
        return status;
    }

    public void setStatus(int status) {
        this.status = status;
    }

    public String getInformation() {
        return information;
    }

    public void setInformation(String information) {
        this.information = information;
    }


    //Customzie function
    public void addObject(T object){
        this.objects.add(object);
    }

    public Object getByNum(int num){
        if(num>=objects.size())
            return null;
        else
            return this.objects.get(num);
    }

}
