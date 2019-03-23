package com.bigdata.hibernate;

import javax.persistence.Basic;
import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.Id;
import java.sql.Date;

@Entity
public class Comment {
    private int idcomment;
    private String customerName;
    private String commentEmail;
    private Date timestamp;
    private String content;

    @Id
    @Column(name = "idcomment", nullable = false)
    public int getIdcomment() {
        return idcomment;
    }

    public void setIdcomment(int idcomment) {
        this.idcomment = idcomment;
    }

    @Basic
    @Column(name = "customer_name", nullable = true, length = 45)
    public String getCustomerName() {
        return customerName;
    }

    public void setCustomerName(String customerName) {
        this.customerName = customerName;
    }

    @Basic
    @Column(name = "comment_email", nullable = true, length = 45)
    public String getCommentEmail() {
        return commentEmail;
    }

    public void setCommentEmail(String commentEmail) {
        this.commentEmail = commentEmail;
    }

    @Basic
    @Column(name = "timestamp", nullable = true)
    public Date getTimestamp() {
        return timestamp;
    }

    public void setTimestamp(Date timestamp) {
        this.timestamp = timestamp;
    }

    @Basic
    @Column(name = "content", nullable = false, length = 300)
    public String getContent() {
        return content;
    }

    public void setContent(String content) {
        this.content = content;
    }

    @Override
    public boolean equals(Object o) {
        if (this == o) return true;
        if (o == null || getClass() != o.getClass()) return false;

        Comment comment = (Comment) o;

        if (idcomment != comment.idcomment) return false;
        if (customerName != null ? !customerName.equals(comment.customerName) : comment.customerName != null)
            return false;
        if (commentEmail != null ? !commentEmail.equals(comment.commentEmail) : comment.commentEmail != null)
            return false;
        if (timestamp != null ? !timestamp.equals(comment.timestamp) : comment.timestamp != null) return false;
        if (content != null ? !content.equals(comment.content) : comment.content != null) return false;

        return true;
    }

    @Override
    public int hashCode() {
        int result = idcomment;
        result = 31 * result + (customerName != null ? customerName.hashCode() : 0);
        result = 31 * result + (commentEmail != null ? commentEmail.hashCode() : 0);
        result = 31 * result + (timestamp != null ? timestamp.hashCode() : 0);
        result = 31 * result + (content != null ? content.hashCode() : 0);
        return result;
    }
}
